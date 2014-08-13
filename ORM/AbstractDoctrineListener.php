<?php

/**
 * This file is part of the KnpDoctrineBehaviors package.
 *
 * (c) KnpLabs <http://knplabs.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kairos\ZohoInvoiceConnectorBundle\ORM;

use Doctrine\Common\EventSubscriber;
use Kairos\ZohoInvoiceConnectorBundle\Reflection\ClassAnalyzer;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class AbstractDoctrineListener implements EventSubscriber
{
    /**
     * @var \Symfony\Bridge\Monolog\Logger
     */
    private $logger;

    /**
     * @var \Kairos\ZohoInvoiceConnectorBundle\Reflection\ClassAnalyzer
     */
    private $classAnalyser;

    /**
     * @var bool
     */
    protected $isRecursive;

    /**
     * @var String
     */
    protected $authToken;

    /**
     * @var String
     */
    protected $organizationId;

    /**
     * @param Logger $logger
     * @param ClassAnalyzer $classAnalyser
     * @param $isRecursive
     * @param $authToken
     * @param $organizationId
     */
    public function __construct(Logger $logger, ClassAnalyzer $classAnalyser, $isRecursive, $authToken, $organizationId)
    {
        $this->classAnalyser = $classAnalyser;
        $this->isRecursive   = (bool) $isRecursive;
        $this->organizationId = $organizationId;
        $this->authToken = $authToken;
        $this->logger = $logger;
    }

    /**
     * @return ClassAnalyzer
     */
    protected function getClassAnalyzer()
    {
        return $this->classAnalyser;
    }

    /**
     * @return Logger
     */
    protected function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param array $array
     * @param array $keys
     * @return bool
     */
    public function arrayHasKeys($array = array(), $keys =  array())
    {
        foreach($keys AS $key) {
            if(array_key_exists($key, $array))
                return true;
        }
        return false;
    }

    /**
     * @param $em
     * @param $uow
     * @param $entity
     * @param bool $newEntity
     */
    public function persistAndRecomputeChangeset($em, $uow, $entity, $newEntity = false) {
        $classMetadata = $em->getClassMetadata(get_class($entity));
        $em->persist($entity);
        if($newEntity) {
            $uow->computeChangeSet($classMetadata, $entity);
        }
        else {
            $uow->recomputeSingleEntityChangeSet($classMetadata, $entity);
        }
    }

    /**
     * @param \Exception $e
     * @param $entity
     */
    public function logAPIError(\Exception $e, $entity)
    {
        $res = $e->getResponse()->json();
        $this->getLogger()->error('[Guzzle error] ' . $e->getMessage());
        $this->getLogger()->error('[Zoho response code] ' . $res['code'] . ' [Zoho error message] ' . $res['message']);
        $entity->setZohoError(array($res['code'] => $res['message']));
    }

    abstract public function getSubscribedEvents();
}