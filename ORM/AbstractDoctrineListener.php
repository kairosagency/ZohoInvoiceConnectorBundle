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
    private $logger;

    private $classAnalyser;

    protected $isRecursive;

    protected $authToken;

    protected $organizationId;


    public function __construct(Logger $logger, ClassAnalyzer $classAnalyser, $isRecursive, $authToken, $organizationId)
    {
        $this->classAnalyser = $classAnalyser;
        $this->isRecursive   = (bool) $isRecursive;
        $this->organizationId = $organizationId;
        $this->authToken = $authToken;
        $this->logger = $logger;
    }

    protected function getClassAnalyzer()
    {
        return $this->classAnalyser;
    }


    protected function getLogger()
    {
        return $this->logger;
    }

    abstract public function getSubscribedEvents();
}