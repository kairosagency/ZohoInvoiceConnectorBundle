<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Item;

use Doctrine\Common\Annotations\AnnotationRegistry AS Assert;

/**
 * ItemConnectorProperties trait.
 *
 */
trait ItemConnectorProperties
{
    /**
     * @var string $zohoItemId
     *
     * @ORM\Column(name="zoho_item_id", type="string", length=255, nullable=true)
     */
    protected $zohoItemId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="zoho_name", type="string", length=255)
     * @Assert\NotBlank(message="The name should not be blank")
     */
    protected $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="zoho_description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var float $rate
     *
     * @ORM\Column(name="zoho_rate", type="float")
     * @Assert\NotBlank(message="The price should not be blank")
     */
    protected $rate;

    /**
     * @var string $unit
     *
     * @ORM\Column(name="zoho_unit", type="string", length=31, nullable = true)
     */
    protected $unit;

    /**
     * @var string $zohoTaxId
     *
     * @ORM\Column(name="zoho_tax_id", type="string", length=31, nullable = true)
     */
    protected $zohoTaxId;

}