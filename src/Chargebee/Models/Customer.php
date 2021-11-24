<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;

/**
 * Representing a chargebee customer
 */
class Customer implements CustomerContract
{
    
    /**
     * Customer id.
     * 
     * @var string
     */
    protected $id;
    
    /**
     * Customer first name.
     * 
     * @var string
     */
    protected $first_name;
    
    /**
     * Customer last name.
     * 
     * @var string
     */
    protected $last_name;
    
    /**
     * Customer email.
     * 
     * @var string
     */
    protected $email;
    /**
     * Setting customer id.
     * 
     * @param string
     * @return CustomerContract
     */
    public function setId(string $id): CustomerContract
    {
        $this->id = $id;

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
        $this->first_name = $first_name;

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
        $this->last_name = $last_name;

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
        $this->email = $email;

        return $this;
    }
    
    /**
     * Getting customer id.
     * 
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    
    /**
     * Getting customer first name.
     * 
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }
    
    /**
     * Getting customer last name.
     * 
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }
    
    /**
     * Getting customer email.
     * 
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Telling if this customer has been persisted to chargebee.
     * 
     * @return bool
     */
    public function isPersisted(): bool
    {
        return !!$this->id;
    }
}