<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Contact;

use Kairos\ZohoInvoiceConnectorBundle\Model AS BaseTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContactConnector trait.
 *
 * Should be used inside entity, that needs to be linked to a zoho product.
 */
trait ContactConnector
{
    use ContactConnectorProperties,
        ContactConnectorSafeProperties,
        ContactConnectorMethods,
        BaseTrait\Synced
        ;
}