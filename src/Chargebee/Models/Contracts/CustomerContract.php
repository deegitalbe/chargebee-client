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
     * @param string $id
     * @return CustomerContract
     */
    public function setId(string $id): CustomerContract;
    
    /**
     * Setting customer first name.
     * 
     * @param string $first_name
     * @return CustomerContract
     */
    public function setFirstName(string $first_name): CustomerContract;
    
    /**
     * Setting customer last name.
     * 
     * @param string $last_name
     * @return CustomerContract
     */
    public function setLastName(string $last_name): CustomerContract;
    
    /**
     * Setting customer email.
     * 
     * @param string $email
     * @return CustomerContract
     */
    public function setEmail(string $email): CustomerContract;

    /**
     * Setting customer locale.
     * 
     * @param string $locale
     * @return CustomerContract
     */
    public function setLocale(string $locale): CustomerContract;
    
    
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
     * Telling if customer vat number could not be verified but was manually confirmed.
     * 
     * @return bool
     */
    public function isUsingUnconventialVatNumber(): bool;
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

    /**
     * Telling if having payment method.
     * 
     * @return bool
     */
    public function isHavingPaymentMethod(): bool;

    /**
     * Getting related payment method.
     * 
     * @return PaymentMethodContract|null
     */
    public function getPaymentMethod(): ?PaymentMethodContract;

    /**
     * Getting customer locale.
     * 
     * @return string|null
     */
    public function getLocale(): ?string;
}