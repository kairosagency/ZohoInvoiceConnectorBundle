<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Contact;

use Doctrine\Common\Annotations\AnnotationRegistry AS Assert;


/**
 * ContactConnectorProperties trait.
 *
 */
trait ContactConnectorProperties
{
    /**
     * @var string $civility
     *
     * @ORM\Column(name="zoho_civility", type="string", length=255, nullable=true)
     */
    protected $civility;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="zoho_first_name", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The firstName should not be blank", groups={"zoho"})
     */
    protected $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="zoho_last_name", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The lastName should not be blank", groups={"zoho"})
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
     * @Assert\NotBlank(message="The Email should not be blank", groups={"zoho"})
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

    /***                            ***/
    /***       Billing address      ***/
    /***                            ***/

    /**
     * @var string $billingStreet
     *
     * @ORM\Column(name="zoho_billing_street", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The street should not be blank", groups={"zoho"})
     */
    protected $billingStreet;

    /**
     * @var string $billingCity
     *
     * @ORM\Column(name="zoho_billing_city", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The city should not be blank", groups={"zoho"})
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
     * @Assert\NotBlank(message="The zip code should not be blank", groups={"zoho"})
     */
    protected $billingZipcode;

    /**
     * @var string $billingCountry
     *
     * @ORM\Column(name="zoho_billing_country", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="The country should not be blank", groups={"zoho"})
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

}