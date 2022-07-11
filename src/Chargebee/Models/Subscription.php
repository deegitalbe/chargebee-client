<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use stdClass;
use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionPlanApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

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
     * Setting trial ending date.
     * 
     * @param Carbon|null $ending_at
     * @return  SubscriptionContract
     */
    public function setTrialEndingAt(?Carbon $ending_at): SubscriptionContract
    {
        $this->getRawSubscription()->trial_end = $ending_at ? $ending_at->timestamp : null;

        return $this;
    }

    /**
     * Setting plan linked to this subscription.
     * 
     * @param SubscriptionPlanContract $plan
     * @return SubscriptionContract
     */
    public function setPlan(SubscriptionPlanContract $plan): SubscriptionContract
    {
        $this->getRawSubscription()->plan_id = $plan->getId();

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
     * Getting trial ending date.
     * 
     * @return Carbon|null Null if not applicable.
     */
    public function getTrialEndingAt(): ?Carbon
    {
        $timestamp = optional($this->getRawSubscription())->trial_end;

        return $timestamp ? new Carbon($timestamp) : null;
    }

    /**
     * Getting ending date.
     * 
     * @return Carbon|null Null if not applicable.
     */
    public function getEndingAt(): ?Carbon
    {
        $timestamp = optional($this->getRawSubscription())->trial_end;

        return $timestamp ? new Carbon($timestamp) : null;
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
     * Getting subscription plan linked to this subscription.
     * 
     * @return SubscriptionPlanContract
     */
    public function getPlan(): SubscriptionPlanContract
    {
        return app()->make(SubscriptionPlanApiContract::class)->find($this->getPlanId());
    }

    /**
     * Getting underlying subscription.
     * 
     * @return stdClass
     */
    public function getRawSubscription(): stdClass
    {
        return $this->attributes->subscription;
    }

    /**
     * Getting linked plan id.
     * 
     * @return string
     */
    protected function getPlanId(): string
    {
        return $this->getRawSubscription()->plan_id;
    }
}
