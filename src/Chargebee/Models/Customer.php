<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\BillingAddressContract;
use stdClass;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;

/**
 * Representing a chargebee customer
 */
class Customer implements CustomerContract
{
    use HasAttributes;

    /**
     * Cosntruction customer instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->attributes = json_decode(json_encode([
            'customer' => new stdClass
        ]));
    }

    /**
     * Setting customer id.
     * 
     * @param string
     * @return static
     */
    public function setId(string $id): CustomerContract
    {
        $this->getRawCustomer()->id = $id;

        return $this;
    }
    
    /**
     * Setting customer first name.
     * 
     * @param string
     * @return static
     */
    public function setFirstName(string $first_name): CustomerContract
    {
        $this->getRawCustomer()->first_name = $first_name;

        return $this;
    }
    
    /**
     * Setting customer last name.
     * 
     * @param string
     * @return static
     */
    public function setLastName(string $last_name): CustomerContract
    {
        $this->getRawCustomer()->last_name = $last_name;

        return $this;
    }
    
    /**
     * Setting customer email.
     * 
     * @param string
     * @return static
     */
    public function setEmail(string $email): CustomerContract
    {
        $this->getRawCustomer()->email = $email;

        return $this;
    }

    /**
     * Setting customer email.
     * 
     * @param string
     * @return static
     */
    public function setVatNumber(string $vatNumber): CustomerContract
    {
        $this->getRawCustomer()->vat_number = preg_replace("/[^[0-9]/", '', $vatNumber);

        return $this;
    }
    
    /**
     * Getting customer id.
     * 
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->getRawCustomer()->id ?? null;
    }
    
    /**
     * Getting customer first name.
     * 
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getRawCustomer()->first_name ?? '';
    }
    
    /**
     * Getting customer last name.
     * 
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getRawCustomer()->last_name ?? '';
    }
    
    /**
     * Getting customer email.
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getRawCustomer()->email ?? '';
    }

    /**
     * Getting related vat number.
     * 
     * @return string
     */
    public function getVatNumber(): string
    {
        return $this->getRawCustomer()->vat_number ?? '';
    }

    /**
     * Telling if having vat number.
     * 
     * @return bool
     */
    public function isHavingVatNumber(): bool
    {
        return !!$this->getVatNumber();
    }

    /**
     * Telling if customer vat number could not be verified but was manually confirmed.
     * 
     * @return bool
     */
    public function isUsingUnconventialVatNumber(): bool
    {
        return $this->getRawCustomer()->business_customer_without_vat_number ?? false;
    }

    /**
     * Getting underlying raw customer.
     * 
     * @return stdClass
     */
    protected function getRawCustomer(): stdClass
    {
        return $this->attributes->customer;
    }

    /**
     * Telling if this customer has been persisted to chargebee.
     * 
     * @return bool
     */
    public function isPersisted(): bool
    {
        return !!$this->getId();
    }

    /**
     * Telling if this customer can be charged.
     * 
     * @return bool
     */
    public function isChargeable(): bool
    {
        return optional($this->getRawCustomer()->payment_method ?? null)->status === 'valid';
    }
    

    /**
     * Telling if having billing address.
     * 
     * @return bool
     */
    public function isHavingBillingAddress(): bool
    {
        return !!($this->getRawCustomer()->billing_address ?? null);
    }

    /**
     * Getting related biiling address.
     * 
     * @return BillingAddressContract|null
     */
    public function getBillingAddress(): ?BillingAddressContract
    {
        return $this->isHavingBillingAddress() ?
            app()->make(BillingAddressContract::class)->setAttributes($this->getRawCustomer()->billing_address)
            : null;
    }
}