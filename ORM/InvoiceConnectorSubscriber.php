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
    Doctrine\ORM\Event\LifecycleEventArgs,
    Doctrine\ORM\Events;

/**
 * InvoiceConnector Doctrine2 listener.
 *
 * Listens to onFlush event and marks SoftDeletable entities
 * as deleted instead of really removing them.
 */
class InvoiceConnectorSubscriber extends AbstractDoctrineListener
{

    protected $invoiceService;

    public function __construct(Logger $logger, ClassAnalyzer $classAnalyser, $isRecursive, $authToken, $organizationId)
    {
        parent::__construct($logger, $classAnalyser, $isRecursive, $authToken, $organizationId);
        $this->invoiceService = ZohoInvoiceApiClient::getService('Invoices/InvoicesService', array('authtoken' => $this->authToken, 'organization_id' => $this->organizationId));
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
                $response = $this->invoiceService->createInvoice(array('JSONString' => $entity->toJson()));
                if(isset($response['invoice']) && isset($response['invoice']['invoice_id'])) {
                    $entity->setZohoInvoiceId($response['invoice']['invoice_id']);
                    $entity->setSynced(true);
                    $em->persist($entity);
                    $em->flush();
                }

            }catch(\Exception $e) {
                // log api error
                $res = $e->getResponse()->json();
                $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
            }

            if($entity->getZohoInvoiceId()) {
                try{
                    $response = $this->invoiceService->emailInvoice(array('invoice_id' => $entity->getZohoInvoiceId()));

                }catch(\Exception $e) {
                    // log api error
                    $res = $e->getResponse()->json();
                    $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                    $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
                }

                try{
                    $response = $this->invoiceService->markSentInvoice(array('invoice_id' => $entity->getZohoInvoiceId()));
                }catch(\Exception $e) {
                    // log api error
                    $res = $e->getResponse()->json();
                    $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
                    $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
                }
            }
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
        return $this->getClassAnalyzer()->hasTrait($classMetadata->reflClass, 'Kairos\ZohoInvoiceConnectorBundle\Model\Invoice\InvoiceConnector', $this->isRecursive);
    }

    /**
     * Returns list of events, that this listener is listening to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postPersist];
    }
}