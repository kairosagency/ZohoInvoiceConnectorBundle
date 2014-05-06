<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model;

/**
 * ItemConnector trait.
 *
 * Should be used inside entity, that needs to be linked to a zoho item.
 */
trait Synced
{
    use SyncedProperties,
        SyncedMethods
        ;
}