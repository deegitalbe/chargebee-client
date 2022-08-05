<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;

/**
 * Representing a chargebee billing
 */
interface BillingAddressContract extends HasAttributesContract
{   
    /**
     * Getting address first name.
     * 
     * @return string
     */
    public function getFirstName(): string;
    
    /**
     * Getting address last name.
     * 
     * @return string
     */
    public function getLastName(): string;
    
    /**
     * Getting address email.
     * 
     * @return string
     */
    public function getEmail(): string;

    /**
     * Getting phone.
     * 
     * @return string
     */
    public function getPhone(): string;

    /**
     * Getting address company.
     * 
     * @return string
     */
    public function getCompany(): string;

    /**
     * Setting address street name.
     * 
     * @return string
     */
    public function getStreetName(): string;

    /**
     * Setting address street number.
     * 
     * @return string
     */
    public function getStreetNumber(): string;

    /**
     * Setting address city.
     * 
     * @return string
     */
    public function getCity(): string;

    /**
     * Setting address postal code.
     * 
     * @return string
     */
    public function getPostalCode(): string;

    /**
     * Setting address country code.
     * 
     * @return string
     */
    public function getCountryCode(): string;

    /**
     * Telling if already validated.
     * 
     * @return bool
     */
    public function isValidated(): bool;

    /**
     * Telling if awaiting validation.
     * 
     * @return bool
     */
    public function isAwaitingValidation(): bool;
}