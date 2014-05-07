<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model;

/**
 * ItemConnectorProperties trait.
 *
 */
trait SyncedProperties
{

    /**
     * @var boolean $synced
     *
     * @ORM\Column(name="synced", type="boolean", nullable=true)
     */
    protected $synced;

    /**
     * @var DateTime $synced
     *
     * @ORM\Column(name="synced_timestamp", type="datetime", nullable=true)
     */
    protected $syncedTimestamp;

}