<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface UpdateBillingInfoRequestContract extends ApiRequestContract
{
  /**
     * Setting customer to work with.
     * 
     * @param string $customerId
     * @return static
     */
    public function setCustomer(string $customerId): UpdateBillingInfoRequestContract;

    /**
     * Setting related vat number.
     * 
     * @param string $vatNumber
     * @return static
     */
    public function setVatNumber(string $vatNumber): UpdateBillingInfoRequestContract;

    /**
     * Setting related vat number country code.
     * 
     * @param string $countryCode
     * @return static
     */
    public function setVatNumberCountryCode(string $countryCode): UpdateBillingInfoRequestContract;

    /**
     * Setting first name.
     * 
     * @param string $firstName
     * @return static
     */
    public function setFirstName(bool $firstName): UpdateBillingInfoRequestContract;

    /**
     * Setting last name.
     * 
     * @param string $lastName
     * @return static
     */
    public function setLastName(bool $lastName): UpdateBillingInfoRequestContract;

    /**
     * Setting email.
     * 
     * @param string $email
     * @return static
     */
    public function setEmail(bool $email): UpdateBillingInfoRequestContract;

    /**
     * Setting phone.
     * 
     * @param string $phone
     * @return static
     */
    public function setPhone(string $phone): UpdateBillingInfoRequestContract;

    /**
     * Setting company.
     * 
     * @param string $company
     * @return static
     */
    public function setCompany(string $company): UpdateBillingInfoRequestContract;

    /**
     * Setting streetNumber.
     * 
     * @param string $streetNumber
     * @return static
     */
    public function setStreetNumber(string $streetNumber): UpdateBillingInfoRequestContract;

    /**
     * Setting streetName.
     * 
     * @param string $streetName
     * @return static
     */
    public function setStreetName(string $streetName): UpdateBillingInfoRequestContract;

    /**
     * Setting postalCode.
     * 
     * @param string $postalCode
     * @return static
     */
    public function setPostalCode(string $postalCode): UpdateBillingInfoRequestContract;

    /**
     * Setting city.
     * 
     * @param string $city
     * @return static
     */
    public function setCity(string $city): UpdateBillingInfoRequestContract;

    /**
     * Related street name.
     * 
     * @return string
     */
    public function getStreetName(): string;

    /**
     * Related street number.
     * 
     * @return string
     */
    public function getStreetNumber(): string;

    /**
     * Setting countryCode.
     * 
     * @param string $countryCode
     * @return static
     */
    public function setCountryCode(string $countryCode): UpdateBillingInfoRequestContract;

    /**
     * Skipping chargebee vat number validation.
     * 
     * This parameter should be given only if you're sure about vat number.
     * 
     * @return UpdateBillingInfoRequestContract
     */
    public function isHavingUnconventialVatNumber(): UpdateBillingInfoRequestContract;

    /**
     * Validating billing info.
     * 
     * @return static
     */
    public function validate(): UpdateBillingInfoRequestContract;

    /**
     * Invalidating billing info.
     * 
     * @return static
     */
    public function invalidate(): UpdateBillingInfoRequestContract;
    
}