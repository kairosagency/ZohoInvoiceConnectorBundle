<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Item;

/**
 * ItemConnectorMethods trait.
 *
 */
trait ItemConnectorMethods
{
    /**
     * Set item id
     *
     * @param string $itemId
     *
     */
    public function setZohoItemId($itemId)
    {
        $this->zohoItemId = $itemId;

        return $this;
    }

    /**
     * Get item id
     *
     * @return string
     */
    public function getZohoItemId()
    {
        return $this->zohoItemId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rate
     *
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set unit
     *
     * @param string $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set taxId
     *
     * @param string $taxId
     */
    public function setZohoTaxId($taxId)
    {
        $this->zohoTaxId = $taxId;

        return $this;
    }

    /**
     * Get taxId
     *
     * @return string
     */
    public function getZohoTaxId()
    {
        return $this->zohoTaxId;
    }

    public function toArray()
    {
        return array(
            'name' => $this->getName(),
            'description' => strip_tags($this->getDescription()),
            'rate' => $this->getRate(),
            'unit' => strval($this->getUnit()),
            'tax_id' => $this->getZohoTaxId(),
        );
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

}