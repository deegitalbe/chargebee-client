<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;

/**
 * Representing a chargebee subscription
 */
interface SubscriptionContract extends HasAttributesContract
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

    /**
     * Getting customer linked to this subscription.
     * 
     * @return CustomerContract
     */
    public function getCustomer(): CustomerContract;
}