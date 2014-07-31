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
 * ContactConnector Doctrine2 listener.
 *
 * Listens to onFlush event and marks SoftDeletable entities
 * as deleted instead of really removing them.
 */
class ContactConnectorSubscriber extends AbstractDoctrineListener
{

    protected $contactService;

    public function __construct(Logger $logger, ClassAnalyzer $classAnalyser, $isRecursive, $authToken, $organizationId)
    {
        parent::__construct($logger, $classAnalyser, $isRecursive, $authToken, $organizationId);
        $this->contactService = ZohoInvoiceApiClient::getService('Contacts/ContactsService', array('authtoken' => $this->authToken, 'organization_id' => $this->organizationId));
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

            $keys = array(
                'email',
                'firstName',
                'lastName',
                'billingStreet',
                'billingCity',
                'billingState',
                'billingZipcode',
                'billingCountry',
                'zohoCurrencyId',
                'civility',
                'companyName',
                'website',
                'contactPhone',
                'contactMobile',
                'zohoCustomField1',
                'zohoCustomField2',
                'zohoCustomField3',
            );
            if($this->arrayHasKeys($changeset, $keys)) {
                $entity->setZohoSynced(false);
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
                $response = $this->contactService->createContact(array('JSONString' => $entity->toJson()));

                if(isset($response['contact']) && isset($response['contact']['contact_id']) && isset($response['contact']['primary_contact_id'])) {
                    $entity->setZohoContactId($response['contact']['contact_id']);
                    $entity->setZohoContactPersonId($response['contact']['primary_contact_id']);
                    $entity->setZohoSynced(true);
                    $em->persist($entity);
                    $em->flush();
                }

            }catch(\Exception $e) {
                // log api error
                $res = $e->getResponse()->json();
                $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
                $entity->setZohoError(array($res['code'] => $res['message']));
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
        if ($this->isEntitySupported($classMetadata) && $entity->getZohoContactId() && $entity->isZohoSynced() == false) {
            try{
                $response = $this->contactService->updateContact(array('contact_id' => $entity->getZohoContactId(), 'JSONString' => $entity->toJson()));
                $entity->setZohoSynced(true);
                $em->persist($entity);
                $em->flush();
            }catch(\Exception $e) {
                // log api error
                $res = $e->getResponse()->json();
                $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
                $entity->setZohoError(array($res['code'] => $res['message']));
            }
        }
        // in case the object was not created on zoho side
        elseif($this->isEntitySupported($classMetadata) && is_null($entity->getZohoContactId())) {
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
        return $this->getClassAnalyzer()->hasTrait($classMetadata->reflClass, 'Kairos\ZohoInvoiceConnectorBundle\Model\Contact\ContactConnector', $this->isRecursive);
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