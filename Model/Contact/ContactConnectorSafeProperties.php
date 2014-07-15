<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Contact;

/**
 * ContactConnectorProperties trait.
 *
 */
trait ContactConnectorSafeProperties
{
    /**
     * Store remote service reference id
     * @var string $contactId
     *
     * @ORM\Column(name="zoho_contact_id", type="string", length=255, nullable=true)
     */
    protected $zohoContactId;

    /**
     * Store remote service contact person id
     * @var string $contactPersonId
     *
     * @ORM\Column(name="zoho_contact_person_id", type="string", length=255, nullable=true)
     */
    protected $zohoContactPersonId;

    /**
     * @var string $zohoCurrencyId
     *
     * @ORM\Column(name="zoho_currency_id", type="string", length=255, nullable=true)
     */
    protected $zohoCurrencyId;

    /**
     * @var string $zohoCustomField1
     *
     * @ORM\Column(name="zoho_custom_field_1", type="string", length=255, nullable=true)
     */
    protected $zohoCustomField1;

    /**
     * @var string $zohoCustomField2
     *
     * @ORM\Column(name="zoho_custom_field_2", type="string", length=255, nullable=true)
     */
    protected $zohoCustomField2;

    /**
     * @var string $zohoCustomField3
     *
     * @ORM\Column(name="zoho_custom_field_3", type="string", length=255, nullable=true)
     */
    protected $zohoCustomField3;

    /***                            ***/
    /***    Default Templates       ***/
    /***                            ***/

    /**
     * @var string $invoiceTemplateName
     *
     */
    protected $invoiceTemplateName;

    /**
     * @var string $invoiceEmailTemplateName
     *
     */
    protected $invoiceEmailTemplateName;

}