<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Customer;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer\UpdateBillingInfoRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class UpdateBillingInfoRequest extends AbstractApiRequest implements UpdateBillingInfoRequestContract
{
    /** @var string */
    protected $streetName = "";

    /** @var string */
    protected $streetNumber = "";

    protected function build(RequestContract $request): RequestContract
    {
        return $request;
    }

    /**
     * Related street name.
     * 
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * Related street number.
     * 
     * @return string
     */
    public function getStreetNumber(): string
    {
        return $this->streetNumber;
    }

      /**
     * Setting customer to work with.
     * 
     * @param string $customerId
     * @return static
     */
    public function setCustomer(string $customerId): UpdateBillingInfoRequestContract
    {
        $this->get()->setUrl("$customerId/update_billing_info");

        return $this;
    }

    /**
     * Setting related vat number.
     * 
     * @param string $vatNumber
     * @return static
     */
    public function setVatNumber(string $vatNumber): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['vat_number' => $vatNumber]);

        return $this;
    }

    /**
     * Setting related vat number country code.
     * 
     * @param string $countryCode
     * @return static
     */
    public function setVatNumberCountryCode(string $countryCode): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['vat_number_prefix' => $countryCode]);
        
        return $this;
    }

    /**
     * Setting first name.
     * 
     * @param string $firstName
     * @return static
     */
    public function setFirstName(bool $firstName): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[first_name]' => $firstName]);

        return $this;
    }

    /**
     * Setting last name.
     * 
     * @param string $lastName
     * @return static
     */
    public function setLastName(bool $lastName): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[last_name]' => $lastName]);

        return $this;
    }

    /**
     * Setting email.
     * 
     * @param string $email
     * @return static
     */
    public function setEmail(bool $email): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[email]' => $email]);
        return $this;
    }

    /**
     * Setting phone.
     * 
     * @param string $phone
     * @return static
     */
    public function setPhone(string $phone): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[phone]' => $phone]);
        return $this;
    }

    /**
     * Setting company.
     * 
     * @param string $company
     * @return static
     */
    public function setCompany(string $company): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[company]' => $company]);
        return $this;
    }

    /**
     * Setting streetNumber.
     * 
     * @param string $streetNumber
     * @return static
     */
    public function setStreetNumber(string $streetNumber): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[]' => $streetNumber]);
        return $this;
    }

    /**
     * Setting streetName.
     * 
     * @param string $streetName
     * @return static
     */
    public function setStreetName(string $streetName): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[]' => $streetName]);
        return $this;
    }

    /**
     * Setting postalCode.
     * 
     * @param string $postalCode
     * @return static
     */
    public function setPostalCode(string $postalCode): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[zip]' => $postalCode]);
        return $this;
    }

    /**
     * Setting city.
     * 
     * @param string $city
     * @return static
     */
    public function setCity(string $city): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[city]' => $city]);
        return $this;
    }

    /**
     * Setting countryCode.
     * 
     * @param string $countryCode
     * @return static
     */
    public function setCountryCode(string $countryCode): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[country]' => $countryCode]);
        return $this;
    }

    /**
     * Skipping chargebee vat number validation.
     * 
     * This parameter should be given only if you're sure about vat number.
     * 
     * @return UpdateBillingInfoRequestContract
     */
    public function isHavingUnconventialVatNumber(): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['business_customer_without_vat_number' => 'true']);
        return $this;
    }

    /**
     * Validating billing info.
     * 
     * @return static
     */
    public function validate(): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[validation_status]' => 'valid']);

        return $this;
    }

    /**
     * Invalidating billing info.
     * 
     * @return static
     */
    public function invalidate(): UpdateBillingInfoRequestContract
    {
        $this->get()->addQuery(['billing_address[validation_status]' => 'invalid']);

        return $this;
    }
}