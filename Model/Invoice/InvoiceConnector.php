<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Invoice;

use Kairos\ZohoInvoiceConnectorBundle\Model AS BaseTrait;

/**
 * InvoiceConnector trait.
 *
 * Should be used inside entity, that needs to be linked to a zoho product.
 */
trait InvoiceConnector
{
    use InvoiceConnectorProperties,
        InvoiceConnectorMethods,
        BaseTrait\Synced
        ;
}