<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

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
     * @return CustomerContract
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
     * @return CustomerContract
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
     * @return CustomerContract
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
     * @return CustomerContract
     */
    public function setEmail(string $email): CustomerContract
    {
        $this->getRawCustomer()->email = $email;

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
        return $this->getRawCustomer()->first_name;
    }
    
    /**
     * Getting customer last name.
     * 
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getRawCustomer()->last_name;
    }
    
    /**
     * Getting customer email.
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getRawCustomer()->email;
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
        return ($this->getRawCustomer()->card_status ?? null) === 'valid';
    }
}