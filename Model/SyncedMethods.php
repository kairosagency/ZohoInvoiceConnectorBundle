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
     * @param boolean $zohoSynced
     *
     */
    public function setZohoSynced($zohoSynced)
    {
        $this->zohoSynced = $zohoSynced;

        return $this;
    }

    /**
     * is synced ?
     *
     * @return boolean
     */
    public function isZohoSynced()
    {
        return $this->zohoSynced;
    }

    /**
     * Set synced
     *
     * @param \DateTime $zohoSyncedTimestamp
     *
     */
    public function setZohoSyncedTimestamp($zohoSyncedTimestamp)
    {
        $this->zohoSyncedTimestamp = $zohoSyncedTimestamp;

        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getZohoSyncedTimestamp()
    {
        return $this->zohoSyncedTimestamp;
    }

    /**
     * Refresh timestamp
     */
    public function refreshZohoSyncedTimestamp()
    {
        $this->zohoSyncedTimestamp = new \DateTime('now');

        return $this;
    }


}