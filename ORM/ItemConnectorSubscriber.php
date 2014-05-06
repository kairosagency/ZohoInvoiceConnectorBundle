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

use Kairos\ZohoInvoiceConnectorBundle\Reflection\ClassAnalyzer;
use Symfony\Bridge\Monolog\Logger;

use Kairos\ZohoInvoiceApi\ZohoInvoiceApiClient;

use Doctrine\Common\Persistence\Mapping\ClassMetadata,
    Doctrine\ORM\Event\PreUpdateEventArgs,
    Doctrine\ORM\Event\LifecycleEventArgs,
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
            $uow = $em->getUnitOfWork();
            $changeset = $uow->getEntityChangeSet($entity);

            unset($changeset['synced']);
            if(count($changeset) > 0) {
                $entity->setSynced(false);
                $em->persist($entity);
                $uow->recomputeSingleEntityChangeSet($classMetadata, $entity);
            }
        }
    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em  = $args->getEntityManager();
        $classMetadata = $em->getClassMetadata(get_class($entity));

        if ($this->isEntitySupported($classMetadata)) {
            try{

                // if zoho tax id is not defined and default tax id is defined, we set the default tax id
                if(is_null($entity->getZohoTaxId()) && $this->defaultTaxId)
                    $entity->setZohoTaxId($this->defaultTaxId);

                $response = $this->itemService->createItem(array('JSONString' => $entity->toJson()));
                if(isset($response['item']) && isset($response['item']['item_id'])) {
                    $entity->setZohoItemId($response['item']['item_id']);
                    $entity->setSynced(true);
                    $em->persist($entity);
                    $em->flush();
                }
                $this->getLogger()->info('call api');

            }catch(\Exception $e) {
                // log api error
                $res = $e->getResponse()->json();
                $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
            }
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em  = $args->getEntityManager();
        $classMetadata = $em->getClassMetadata(get_class($entity));

        // can update only if entity is suported and contact id is set
        if ($this->isEntitySupported($classMetadata) && $entity->getZohoItemId() && $entity->isSynced() == false) {
            try{
                $response = $this->itemService->updateItem(array('item_id' => $entity->getZohoItemId(), 'JSONString' => $entity->toJson()));
                $entity->setSynced(true);
                $em->persist($entity);
                $em->flush();
            } catch(\Exception $e) {
                // log api error
                $res = $e->getResponse()->json();
                $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
            }
        }
        // in case the object was not created on zoho side
        elseif($this->isEntitySupported($classMetadata) && is_null($entity->getZohoItemId())) {
            $this->postPersist($args);
        }
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
        return [Events::preUpdate, Events::postUpdate, Events::postPersist];
    }
}