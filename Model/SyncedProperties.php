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
     * @ORM\Column(name="zoho_synced", type="boolean", nullable=true)
     */
    protected $zohoSynced = false;

    /**
     * @var DateTime $synced
     *
     * @ORM\Column(name="zoho_synced_timestamp", type="datetime", nullable=true)
     */
    protected $zohoSyncedTimestamp;

    /**
     * @var array $zohoErrors
     *
     */
    protected $zohoError;

}