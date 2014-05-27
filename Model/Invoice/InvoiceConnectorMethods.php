<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Invoice;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * InvoiceConnectorMethods trait.
 *
 */
trait InvoiceConnectorMethods
{
    /**
     * Set invoice id
     *
     * @param string $invoiceId
     *
     */
    public function setZohoInvoiceId($invoiceId)
    {
        $this->zohoInvoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get invoice id
     *
     * @return string
     */
    public function getZohoInvoiceId()
    {
        return $this->zohoInvoiceId;
    }
    
    /**
     * Set customer id
     *
     * @param string $customerId
     *
     */
    public function setZohoCustomerId($customerId)
    {
        $this->zohoCustomerId = $customerId;

        return $this;
    }

    /**
     * Get customer id
     *
     * @return string
     */
    public function getZohoCustomerId()
    {
        return $this->zohoCustomerId;
    }

    /**
     * Set ZohoInvoiceNumber
     *
     * @param string $invoiceNumber
     *
     */
    public function setZohoInvoiceNumber($invoiceNumber)
    {
        $this->zohoInvoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get ZohoInvoiceNumber
     *
     * @return string
     */
    public function getZohoInvoiceNumber()
    {
        return $this->zohoInvoiceNumber;
    }

    /**
     * Set payInvoice
     *
     * @param boolean $payInvoice
     *
     */
    public function setPayInvoice($payInvoice)
    {
        $this->payInvoice = $payInvoice;

        return $this;
    }

    /**
     * get payInvoice
     *
     * @return boolean
     */
    public function getPayInvoice()
    {
        return $this->payInvoice;
    }

    /**
     * Set send invoice
     *
     * @param boolean $sendInvoice
     *
     */
    public function setSendInvoice($sendInvoice)
    {
        $this->sendInvoice = $sendInvoice;

        return $this;
    }

    /**
     * Get sendInvoice
     *
     * @return boolean
     */
    public function getSendInvoice()
    {
        return $this->sendInvoice;
    }

    /**
     * Set invoice total
     *
     * @param float $invoiceTotal
     *
     */
    public function setInvoiceTotal($invoiceTotal)
    {
        $this->invoiceTotal = $invoiceTotal;

        return $this;
    }

    /**
     * Get invoiceTotal
     *
     * @return float
     */
    public function getInvoiceTotal()
    {
        return $this->invoiceTotal;
    }

    /**
     * Set invoice args
     *
     * @param array $customerId
     *
     */
    public function setInvoiceArgs($invoiceArgs)
    {
        $this->invoiceArgs = $invoiceArgs;

        return $this;
    }

    /**
     * Get customer id
     *
     * @return string
     */
    public function getInvoiceArgs()
    {
        if(is_null($this->invoiceArgs))
            $this->invoiceArgs = array();

        return $this->invoiceArgs;
    }

    /**
     * Set items
     *
     * @param ArrayCollection $items
     *
     */
    public function setItems(ArrayCollection $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return ArrayCollection
     */
    public function getItems()
    {
        if(is_null($this->items))
            $this->items = new ArrayCollection();

        return $this->items;
    }

    /**
     * Add item
     *
     * @param array $item
     * @return ArrayCollection
     */
    public function addItem($item)
    {
        if(is_null($this->items))
            $this->items = new ArrayCollection();

        if(!isset($item['item_id']))
            throw new \Exception('Item id is missing');

        if(!isset($item['quantity']))
            throw new \Exception('Quantity is missing');

        $this->items->add($item);

        return $this;
    }

    /**
     * Set contact persons
     *
     * @param ArrayCollection $contactPersons
     *
     */
    public function setZohoContactPersons(ArrayCollection $contactPersons)
    {
        $this->zohoContactPersons = $contactPersons;

        return $this;
    }

    /**
     * Get items
     *
     * @return ArrayCollection
     */
    public function getZohoContactPersons()
    {
        if(is_null($this->zohoContactPersons))
            $this->zohoContactPersons = new ArrayCollection();

        return $this->zohoContactPersons;
    }

    /**
     * Add item
     *
     * @param string $contactPerson
     * @return ArrayCollection
     */
    public function addZohoContactPerson($contactPerson)
    {
        if(is_null($this->zohoContactPersons))
            $this->zohoContactPersons = new ArrayCollection();

        $this->zohoContactPersons->add($contactPerson);

        return $this;
    }


    /**
     * Compile all settings into an array
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge(
            array('line_items' => $this->getItems()->toArray()),
            array('contact_persons' => $this->getZohoContactPersons()->toArray()),
            $this->getInvoiceArgs(),
            array(
                'customer_id' => $this->getZohoCustomerId(),
            )
        );
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}