<?php

/*
 * This file is part of the KnpDoctrineBehaviors package.
 *
 * (c) KnpLabs <http://knplabs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kairos\ZohoInvoiceConnectorBundle\ORM;

use Doctrine\ORM\EntityManager;
use Kairos\ZohoInvoiceConnectorBundle\Reflection\ClassAnalyzer;
use Symfony\Bridge\Monolog\Logger;

use Kairos\ZohoInvoiceApi\ZohoInvoiceApiClient;

use Doctrine\Common\Persistence\Mapping\ClassMetadata,
    Doctrine\ORM\Event\PreUpdateEventArgs,
    Doctrine\ORM\Event\OnFlushEventArgs,
    Doctrine\ORM\Events;

/**
 * ItemConnector Doctrine2 listener.
 *
 * Listens to onFlush event and marks SoftDeletable entities
 * as deleted instead of really removing them.
 */
class ItemConnectorSubscriber extends AbstractDoctrineListener
{

    protected $itemService;

    protected $defaultTaxId;

    public function __construct(Logger $logger, ClassAnalyzer $classAnalyser, $isRecursive, $authToken, $organizationId, $defaultTaxId)
    {
        parent::__construct($logger, $classAnalyser, $isRecursive, $authToken, $organizationId);
        $this->defaultTaxId = $defaultTaxId;
        $this->itemService = ZohoInvoiceApiClient::getService('Settings/ItemsService', array('authtoken' => $this->authToken, 'organization_id' => $this->organizationId));
    }

    /**
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        $em  = $args->getEntityManager();
        $classMetadata = $em->getClassMetadata(get_class($entity));
        // can update only if entity is supported and some properties have changed (except the synced to avoid loops ...)
        if ($this->isEntitySupported($classMetadata)) {
            $this->getLogger()->info('[ZohoItemConnectorSubscriber] preUpdate');
            $uow = $em->getUnitOfWork();
            $changeset = $uow->getEntityChangeSet($entity);

            $keys = array(
                'name',
                'description',
                'rate',
                'unit',
                'zohoTaxId',
            );
            if($this->arrayHasKeys($changeset, $keys)) {
                $entity->setZohoSynced(false);
                $em->persist($entity);
                $uow->recomputeSingleEntityChangeSet($classMetadata, $entity);
            }
        }
    }


    /**
     * @param OnFlushEventArgs $eventArgs
     */
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            $classMetadata = $em->getClassMetadata(get_class($entity));
            if($this->isEntitySupported($classMetadata)) {
                $this->getLogger()->info('[ZohoItemConnectorSubscriber][onFlush] Scheduled for insertion');
                $this->postPersist($em, $uow, $entity);
            }
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            $classMetadata = $em->getClassMetadata(get_class($entity));
            if($this->isEntitySupported($classMetadata)) {
                $this->getLogger()->info('[ZohoItemConnectorSubscriber][onFlush] Scheduled for updates');
                $this->postUpdate($em, $uow, $entity);
            }
        }
    }

    /**
     * @param EntityManager $em
     * @param $uow
     * @param $entity
     */
    private function postPersist(EntityManager $em, $uow, $entity)
    {
        try{
            // if zoho tax id is not defined and default tax id is defined, we set the default tax id
            if(is_null($entity->getZohoTaxId()) && $this->defaultTaxId) {
                $entity->setZohoTaxId($this->defaultTaxId);
            }

            $response = $this->itemService->createItem(array('JSONString' => $entity->toJson()));
            if(isset($response['item']) && isset($response['item']['item_id'])) {
                $entity->setZohoItemId($response['item']['item_id']);
                $entity->setZohoSynced(true);
                $this->persistAndRecomputeChangeset($em, $uow, $entity, true);
            }
        } catch(\Exception $e) {
            // log api error
            $this->logAPIError($e, $entity);
        }
    }

    /**
     * @param EntityManager $em
     * @param $uow
     * @param $entity
     */
    private function postUpdate(EntityManager $em, $uow, $entity)
    {
        if ($entity->getZohoItemId() && $entity->isZohoSynced() == false) {
            try{
                $response = $this->itemService->updateItem(array('item_id' => $entity->getZohoItemId(), 'JSONString' => $entity->toJson()));
                $entity->setZohoSynced(true);
                $this->persistAndRecomputeChangeset($em, $uow, $entity);
            } catch(\Exception $e) {
                // log api error
                $this->logAPIError($e, $entity);
            }
        }
        // in case the object was not created on zoho side
        elseif(is_null($entity->getZohoItemId())) {
            $this->postPersist($em, $uow, $entity);
        }
    }

    /**
     * @param \Exception $e
     * @param $entity
     */
    private function logAPIError(\Exception $e, $entity)
    {
        $res = $e->getResponse()->json();
        $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
        $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
        $entity->setZohoError(array($res['code'] => $res['message']));
    }

    /**
     * Checks whether provided entity is supported.
     *
     * @param ClassMetadata $classMetadata The metadata
     *
     * @return Boolean
     */
    private function isEntitySupported(ClassMetadata $classMetadata)
    {
        return $this->getClassAnalyzer()->hasTrait($classMetadata->reflClass, 'Kairos\ZohoInvoiceConnectorBundle\Model\Item\ItemConnector', $this->isRecursive);
    }

    /**
     * Returns list of events, that this listener is listening to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::preUpdate, Events::onFlush];
        //return [Events::preUpdate, Events::postUpdate, Events::postPersist];
    }
}