<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Invoice;


/**
 * InvoiceConnectorProperties trait.
 *
 */
trait InvoiceConnectorProperties
{
    /**
     * @var string $invoiceId
     *
     * @ORM\Column(name="zoho_invoice_id", type="string", length=255, nullable=true)
     */
    protected $zohoInvoiceId;

    /**
     * @var string $customerId
     *
     * @ORM\Column(name="zoho_customer_id", type="string", length=255, nullable=true)
     */
    protected $zohoCustomerId;

    /**
     * @var array $invoiceArgs
     *
     */
    protected $invoiceArgs;

    /**
     * Should send invoice ?
     *
     * @var boolean $sendInvoice
     */
    protected $sendInvoice;

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