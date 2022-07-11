<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

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
     * Setting trial ending date.
     * 
     * @param Carbon|null $ending_at
     * @return  SubscriptionContract
     */
    public function setTrialEndingAt(?Carbon $ending_at): SubscriptionContract;
    
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
     * Getting trial ending date.
     * 
     * @return Carbon|null Null if not applicable.
     */
    public function getTrialEndingAt(): ?Carbon;

    /**
     * Getting starting date.
     * 
     * @return Carbon|null Null if not applicable.
     */
    public function getStartedAt(): ?Carbon;

    /**
     * Getting ending date.
     * 
     * @return Carbon|null Null if not applicable.
     */
    public function getEndingAt(): ?Carbon;

    /**
     * Getting customer linked to this subscription.
     * 
     * @return CustomerContract
     */
    public function getCustomer(): CustomerContract;

    /**
     * Setting plan linked to this subscription.
     * 
     * @param SubscriptionPlanContract $plan
     * @return SubscriptionContract
     */
    public function setPlan(SubscriptionPlanContract $plan): SubscriptionContract;

    /**
     * Getting subscription plan linked to this subscription.
     * 
     * @return SubscriptionPlanContract
     */
    public function getPlan(): SubscriptionPlanContract;
}