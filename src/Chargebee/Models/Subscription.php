<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use stdClass;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;

/**
 * Representing a chargebee subscription
 */
class Subscription implements SubscriptionContract
{
    use HasAttributes;

    /**
     * Cosntruction subscription instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->attributes = json_decode(json_encode([
            'subscription' => new stdClass
        ]));
    }

    /**
     * Setting subscription id.
     * 
     * @param string
     * @return SubscriptionContract
     */
    public function setId(string $id): SubscriptionContract
    {
        $this->getRawSubscription()->id = $id;

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
        $this->getRawSubscription()->status = $status;

        return $this;
    }
    
    /**
     * Getting subscription id.
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->getRawSubscription()->id;
    }
    
    /**
     * Getting subscription status.
     * 
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getRawSubscription()->status;
    }

    /**
     * Getting customer linked to this subscription.
     * 
     * @return CustomerContract
     */
    public function getCustomer(): CustomerContract
    {
        return app()->make(CustomerContract::class)->setAttributes($this->attributes);
    }

    /**
     * Getting underlying subscription.
     * 
     * @return stdClass
     */
    protected function getRawSubscription(): stdClass
    {
        return $this->attributes->subscription;
    }
}