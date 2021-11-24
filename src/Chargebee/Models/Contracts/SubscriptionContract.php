<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

/**
 * Representing a chargebee subscription
 */
interface SubscriptionContract
{
    /**
     * Setting subscription id.
     * 
     * @param string
     * @return SubscriptionContract
     */
    public function setId(string $id): SubscriptionContract;
    
    /**
     * Setting subscription status.
     * 
     * @param string
     * @return SubscriptionContract
     */
    public function setStatus(string $status): SubscriptionContract;
    
    /**
     * Getting subscription id.
     * 
     * @return string
     */
    public function getId(): string;
    
    /**
     * Getting subscription status.
     * 
     * @return string
     */
    public function getStatus(): string;
}