<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;

/**
 * Representing a chargebee subscription
 */
class Subscription implements SubscriptionContract
{

    /**
     * Subscription id
     * 
     * @var string
     */
    protected $id;

    /**
     * Subscription status
     * 
     * @var string
     */
    protected $status;
    
    /**
     * Setting subscription id.
     * 
     * @param string
     * @return SubscriptionContract
     */
    public function setId(string $id): SubscriptionContract
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * Setting subscription status.
     * 
     * @param string
     * @return SubscriptionContract
     */
    public function setStatus(string $status): SubscriptionContract
    {
        $this->status = $status;

        return $this;
    }
    
    /**
     * Getting subscription id.
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    
    /**
     * Getting subscription status.
     * 
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}