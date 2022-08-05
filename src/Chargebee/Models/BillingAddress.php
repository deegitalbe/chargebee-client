<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\BillingAddressContract;
use stdClass;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;

/**
 * Representing a chargebee customer
 */
class BillingAddress implements BillingAddressContract
{
    use HasAttributes;
    
    /**
     * Getting customer first name.
     * 
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getAttributes()->first_name ?? '';
    }
    
    /**
     * Getting customer last name.
     * 
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getAttributes()->last_name ?? '';
    }
    
    /**
     * Getting customer email.
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttributes()->email ?? '';
    }

    /**
     * Getting address company.
     * 
     * @return string
     */
    public function getCompany(): string
    {
        return $this->getAttributes()->company ?? '';
    }

    /**
     * Setting address street name.
     * 
     * @return string
     */
    public function getStreetName(): string
    {
        return preg_replace("/\s[0-9][\s\S]*/", '', $this->getAttributes()->line1 ?? '');
    }

    /**
     * Setting address street number.
     * 
     * @return string
     */
    public function getStreetNumber(): string
    {
        return str_replace("{$this->getStreetName()} ", '', $this->getAttributes()->line1 ?? '');
    }

    /**
     * Setting address city.
     * 
     * @return string
     */
    public function getCity(): string
    {
        return $this->getAttributes()->city ?? '';
    }

    /**
     * Setting address postal code.
     * 
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->getAttributes()->zip ?? '';
    }

    /**
     * Setting address country code.
     * 
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->getAttributes()->country ?? '';
    }

    /**
     * Setting phone.
     * 
     * @return string
     */
    public function getPhone(): string
    {
        return $this->getAttributes()->phone ?? '';
    }

    /**
     * Telling if already validated.
     * 
     * @return bool
     */
    public function isValidated(): bool
    {
        return ($this->getAttributes()->validation_status ?? '') === 'valid';
    }

    /**
     * Telling if awaiting validation.
     * 
     * @return bool
     */
    public function isAwaitingValidation(): bool
    {
        return !$this->isValidated();
    }

    /**
     * Getting underlying attributes.
     * 
     * @return stdClass
     */
    protected function getAttributes(): stdClass
    {
        return $this->attributes ?? $this->attributes = new stdClass();
    }
}