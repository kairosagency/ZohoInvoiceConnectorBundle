<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Invoice;


/**
 * InvoiceConnectorProperties trait.
 *
 */
trait InvoiceConnectorProperties
{
    /**
     * @var string $zohoInvoiceId
     *
     * @ORM\Column(name="zoho_invoice_id", type="string", length=255, nullable=true)
     */
    protected $zohoInvoiceId;

    /**
     * @var string $zohoCustomerId
     *
     * @ORM\Column(name="zoho_customer_id", type="string", length=255, nullable=true)
     */
    protected $zohoCustomerId;

    /**
     * @var string $zohoInvoiceNumber
     *
     * @ORM\Column(name="zoho_invoice_number", type="string", length=255, nullable=true)
     */
    protected $zohoInvoiceNumber;

    /**
     * @var float $invoiceTotal
     * @ORM\Column(name="zoho_invoice_total", type="float", nullable=true)
     */
    protected $invoiceTotal;

    /**
     * @var boolean $payInvoice
     *
     */
    protected $payInvoice = false;

    /**
     * Should send invoice ?
     *
     * @var boolean $sendInvoice
     */
    protected $sendInvoice = false;

    /**
     * @var array $invoiceArgs
     *
     */
    protected $invoiceArgs;
    /**
     * Array of items in the invoice
     * @var ArrayCollection $items
     */
    protected $items;

    /**
     * Array of items in the invoice
     * @var ArrayCollection $contactPersons
     */
    protected $zohoContactPersons;
}