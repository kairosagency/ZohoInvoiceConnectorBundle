<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Item;

use Kairos\ZohoInvoiceConnectorBundle\Model AS BaseTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ItemConnector trait.
 *
 * Should be used inside entity, that needs to be linked to a zoho item.
 */
trait ItemConnector
{
    use ItemConnectorProperties,
        ItemConnectorMethods,
        BaseTrait\Synced
        ;
}