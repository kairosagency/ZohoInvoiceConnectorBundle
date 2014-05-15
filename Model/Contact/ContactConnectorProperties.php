<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Contact;

/**
 * ContactConnectorProperties trait.
 *
 */
trait ContactConnectorProperties
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
     * @var string $civility
     *
     * @ORM\Column(name="zoho_civility", type="string", length=255, nullable=true)
     */
    protected $civility;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="zoho_firstName", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The firstName should not be blank")
     */
    protected $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="zoho_lastName", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The lastName should not be blank")
     */
    protected $lastName;

    /**
     * @var string $companyName
     *
     * @ORM\Column(name="zoho_company_name", type="string", length=255, nullable=true)
     */
    protected $companyName;

    /**
     * @var string $website
     *
     * @ORM\Column(name="zoho_website", type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @var string $email
     *
     * @ORM\Column(name="zoho_contact_email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var string $contactPhone
     *
     * @ORM\Column(name="zoho_contact_phone", type="string", length=255, nullable=true)
     */
    protected $contactPhone;

    /**
     * @var string $contactMobile
     *
     * @ORM\Column(name="zoho_contact_mobile", type="string", length=255, nullable=true)
     */
    protected $contactMobile;

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
    /***       Billing address      ***/
    /***                            ***/

    /**
     * @var string $billingStreet
     *
     * @ORM\Column(name="zoho_billing_street", type="string", length=255, nullable=true)
     */
    protected $billingStreet;

    /**
     * @var string $billingCity
     *
     * @ORM\Column(name="zoho_billing_city", type="string", length=255, nullable=true)
     */
    protected $billingCity;

    /**
     * @var string $billingState
     *
     * @ORM\Column(name="zoho_billing_state", type="string", length=255, nullable=true)
     */
    protected $billingState;

    /**
     * @var string $billingZipcode
     *
     * @ORM\Column(name="zoho_billing_zipcode", type="string", length=255, nullable=true)
     */
    protected $billingZipcode;

    /**
     * @var string $billingCountry
     *
     * @ORM\Column(name="zoho_billing_country", type="string", length=255, nullable=true)
     */
    protected $billingCountry;


    /***                            ***/
    /***      Shipping address      ***/
    /***                            ***/

    /**
     * @var string $shippingStreet
     *
     * @ORM\Column(name="zoho_shipping_street", type="string", length=255, nullable=true)
     */
    protected $shippingStreet;

    /**
     * @var string $shippingCity
     *
     * @ORM\Column(name="zoho_shipping_city", type="string", length=255, nullable=true)
     */
    protected $shippingCity;

    /**
     * @var string $shippingState
     *
     * @ORM\Column(name="zoho_shipping_state", type="string", length=255, nullable=true)
     */
    protected $shippingState;

    /**
     * @var string $shippingZipcode
     *
     * @ORM\Column(name="zoho_shipping_zipcode", type="string", length=255, nullable=true)
     */
    protected $shippingZipcode;

    /**
     * @var string $shippingCountry
     *
     * @ORM\Column(name="zoho_shipping_country", type="string", length=255, nullable=true)
     */
    protected $shippingCountry;



    /***                            ***/
    /***    Default Templates       ***/
    /***                            ***/

    /**
     * @var string $invoiceTemplateName
     *
     * @ORM\Column(name="zoho_invoice_template_name", type="string", length=255, nullable=true)
     */
    protected $invoiceTemplateName;

    /**
     * @var string $invoiceEmailTemplateName
     *
     * @ORM\Column(name="zoho_invoice_email_template_name", type="string", length=255, nullable=true)
     */
    protected $invoiceEmailTemplateName;

}