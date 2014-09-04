<?php

namespace Kairos\ZohoInvoiceConnectorBundle\Model\Contact;

use Symfony\Component\Intl\Intl;

/**
 * ContactConnectorMethods trait.
 *
 */
trait ContactConnectorMethods
{
    /**
     * Set contact id
     *
     * @param string $contactId
     *
     */
    public function setZohoContactId($contactId)
    {
        $this->zohoContactId = $contactId;

        return $this;
    }

    /**
     * Get contact id
     *
     * @return string
     */
    public function getZohoContactId()
    {
        return $this->zohoContactId;
    }
    /**
     * Set contact person id
     *
     * @param string $contactPersonId
     *
     */
    public function setZohoContactPersonId($contactPersonId)
    {
        $this->zohoContactPersonId = $contactPersonId;

        return $this;
    }

    /**
     * Get contact person id
     *
     * @return string
     */
    public function getZohoContactPersonId()
    {
        return $this->zohoContactPersonId;
    }
    
    /**
     * Set civility
     *
     * @param string $civility
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return string
     */
    public function getCivility()
    {
        return $this->civility;
    }


    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->civility . ' ' . $this->firstName . ' ' .  $this->lastName . ' (' . $this->companyName . ')';
    }

    /**
     * Set company name
     *
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get $companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set website
     *
     * @param string $companyName
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get $website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set $email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contactPhone
     *
     * @param string $contactPhone
     */
    public function setContactPhone($contactPhone)
    {
        $this->contactPhone = $contactPhone;

        return $this;
    }

    /**
     * Get contactPhone
     *
     * @return string
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * Set contactMobile
     *
     * @param string $contactMobile
     */
    public function setContactMobile($contactMobile)
    {
        $this->contactMobile = $contactMobile;

        return $this;
    }

    /**
     * Get contactMobile
     *
     * @return string
     */
    public function getContactMobile()
    {
        return $this->contactMobile;
    }


    /***                            ***/
    /***       Billing address      ***/
    /***                            ***/

    /**
     * Set street
     *
     * @param string $billingStreet
     */
    public function setBillingStreet($billingStreet)
    {
        $this->billingStreet = $billingStreet;

        return $this;
    }


    /**
     * Get street
     *
     * @return string
     */
    public function getBillingStreet()
    {
        return $this->billingStreet;
    }

    /**
     * Set city
     *
     * @param string $billingCity
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * Set state
     *
     * @param string $billingState
     */
    public function setBillingState($billingState)
    {
        $this->billingState = $billingState;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getBillingState()
    {
        return $this->billingState;
    }

    /**
     * Set zipcode
     *
     * @param string $billingZipcode
     */
    public function setBillingZipcode($billingZipcode)
    {
        $this->billingZipcode = $billingZipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getBillingZipcode()
    {
        return $this->billingZipcode;
    }

    /**
     * Set country
     *
     * @param string $billingCountry
     */
    public function setbillingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->billingCountry;
    }



    /***                            ***/
    /***      Shipping address      ***/
    /***                            ***/

    /**
     * Set street
     *
     * @param string $shippingStreet
     */
    public function setShippingStreet($shippingStreet)
    {
        $this->shippingStreet = $shippingStreet;

        return $this;
    }


    /**
     * Get street
     *
     * @return string
     */
    public function getShippingStreet()
    {
        return $this->shippingStreet;
    }

    /**
     * Set city
     *
     * @param string $shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->shippingCity = $shippingCity;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    /**
     * Set state
     *
     * @param string $shippingState
     */
    public function setShippingState($shippingState)
    {
        $this->shippingState = $shippingState;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getShippingState()
    {
        return $this->shippingState;
    }

    /**
     * Set zipcode
     *
     * @param string $shippingZipcode
     */
    public function setShippingZipcode($shippingZipcode)
    {
        $this->shippingZipcode = $shippingZipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getShippingZipcode()
    {
        return $this->shippingZipcode;
    }

    /**
     * Set country
     *
     * @param string $shippingCountry
     */
    public function setshippingCountry($shippingCountry)
    {
        $this->shippingCountry = $shippingCountry;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getShippingCountry()
    {
        return $this->shippingCountry;
    }


    /**
     * Set invoice template name
     *
     * @param string $invoiceTemplateName
     */
    public function setInvoiceTemplateName($invoiceTemplateName)
    {
        $this->invoiceTemplateName = $invoiceTemplateName;

        return $this;
    }

    /**
     * Get invoice template name
     *
     * @return string
     */
    public function getInvoiceTemplateName()
    {
        return $this->invoiceTemplateName;
    }


    /**
     * Set invoice email template name
     *
     * @param string $invoiceEmailTemplateName
     */
    public function setInvoiceEmailTemplateName($invoiceEmailTemplateName)
    {
        $this->invoiceEmailTemplateName = $invoiceEmailTemplateName;

        return $this;
    }

    /**
     * Get invoice template name
     *
     * @return string
     */
    public function getInvoiceEmailTemplateName()
    {
        return $this->invoiceEmailTemplateName;
    }

    /**
     * Serialize to array
     *
     * @return array
     */
    public function toArray()
    {
        // format billing and shipping country
        $billingCountry = $this->getBillingCountry();
        $billingCountry = !empty($billingCountry) ? Intl::getRegionBundle()->getCountryName($billingCountry): '';

        $shippingCountry = $this->getShippingCountry();
        $shippingCountry = !empty($shippingCountry) ? Intl::getRegionBundle()->getCountryName($shippingCountry): '';

        $res = array(
            'contact_name' => $this->getFullname(),
            'company_name' => $this->getCompanyName(),
            'website' => $this->getWebsite(),
            'contact_persons' => array(
            ),
            'billing_address' => array(
                'address' => strval($this->getBillingStreet()),
                'city' => strval($this->getBillingCity()),
                'state' => strval($this->getBillingState()),
                'zip' => strval($this->getBillingZipcode()),
                'country' => $billingCountry,
            ),
            'shipping_address' => array(
                'address' => strval($this->getShippingStreet()),
                'city' => strval($this->getShippingCity()),
                'state' => strval($this->getShippingState()),
                'zip' => strval($this->getShippingZipcode()),
                'country' => $shippingCountry,
            )
        );

        if(!is_null($this->getZohoContactPersonId()))
            $res['contact_persons'][] = array(
                'contact_person_id' => $this->getZohoContactPersonId(),
                'salutation' => $this->getCivility(),
                'first_name' => $this->getFirstName(),
                'last_name' => $this->getLastName(),
                'email' => $this->getEmail(),
                'phone' => $this->getContactPhone(),
                'mobile' => $this->getContactMobile(),
                'is_primary_contact' => true
            );
        else
            $res['contact_persons'][] = array(
                'salutation' => $this->getCivility(),
                'first_name' => $this->getFirstName(),
                'last_name' => $this->getLastName(),
                'email' => $this->getEmail(),
                'phone' => $this->getContactPhone(),
                'mobile' => $this->getContactMobile(),
                'is_primary_contact' => true
            );


        if($this->getInvoiceTemplateName()) {
            if(!isset($res['default_templates']))
                $res['default_templates'] = array();

            $res['default_templates']['invoice_template_name'] = $this->getInvoiceTemplateName();
        }

        if($this->getInvoiceEmailTemplateName()) {
            if(!isset($res['default_templates']))
                $res['default_templates'] = array();

            $res['default_templates']['invoice_email_template_name'] = $this->getInvoiceEmailTemplateName();
        }
        return $res;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}