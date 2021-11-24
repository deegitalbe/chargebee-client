<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

/**
 * Representing a chargebee customer
 */
interface CustomerContract
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
     * Telling if this customer has been persisted to chargebee.
     * 
     * @return bool
     */
    public function isPersisted(): bool;
}