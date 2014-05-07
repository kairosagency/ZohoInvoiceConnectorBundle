<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model;

/**
 * ItemConnectorMethods trait.
 *
 */
trait SyncedMethods
{
    /**
     * Set synced
     *
     * @param boolean $synced
     *
     */
    public function setSynced($synced)
    {
        $this->synced = $synced;

        return $this;
    }

    /**
     * is synced ?
     *
     * @return boolean
     */
    public function isSynced()
    {
        return $this->synced;
    }

    /**
     * Set synced
     *
     * @param \DateTime $syncedTimestamp
     *
     */
    public function setSyncedTimestamp($syncedTimestamp)
    {
        $this->syncedTimestamp = $syncedTimestamp;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getSyncedTimestamp()
    {
        return $this->syncedTimestamp;
    }

    /**
     * Refresh timestamp
     */
    public function refreshSyncedTimestamp()
    {
        $this->syncedTimestamp = new \DateTime('now');

        return $this;
    }


}