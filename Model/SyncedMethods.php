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


}