<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;

/**
 * Representing a chargebee customer
 */
interface CustomerContract extends HasAttributesContract
{
    /**
     * Setting customer id.
     * 
     * @param string
     * @return CustomerContract
     */
    public function setId(string $id): CustomerContract;
    
    /**
     * Setting customer first name.
     * 
     * @param string
     * @return CustomerContract
     */
    public function setFirstName(string $first_name): CustomerContract;
    
    /**
     * Setting customer last name.
     * 
     * @param string
     * @return CustomerContract
     */
    public function setLastName(string $last_name): CustomerContract;
    
    /**
     * Setting customer email.
     * 
     * @param string
     * @return CustomerContract
     */
    public function setEmail(string $email): CustomerContract;
    
    /**
     * Getting customer id.
     * 
     * @return string|null
     */
    public function getId(): ?string;
    
    /**
     * Getting customer first name.
     * 
     * @return string
     */
    public function getFirstName(): string;
    
    /**
     * Getting customer last name.
     * 
     * @return string
     */
    public function getLastName(): string;
    
    /**
     * Getting customer email.
     * 
     * @return string
     */
    public function getEmail(): string;

    /**
     * Getting related vat number.
     * 
     * @return string
     */
    public function getVatNumber(): string;

    /**
     * Telling if having vat number.
     * 
     * @return bool
     */
    public function isHavingVatNumber(): bool;

    /**
     * Telling if this customer has been persisted to chargebee.
     * 
     * @return bool
     */
    public function isPersisted(): bool;

    /**
     * Telling if this customer can be charged.
     * 
     * @return bool
     */
    public function isChargeable(): bool;

    /**
     * Telling if having billing address.
     * 
     * @return bool
     */
    public function isHavingBillingAddress(): bool;

    /**
     * Getting related biiling address.
     * 
     * @return BillingAddressContract|null
     */
    public function getBillingAddress(): ?BillingAddressContract;
}