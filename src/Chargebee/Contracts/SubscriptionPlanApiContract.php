<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

/**
 * Subscription plan repository.
 */
interface SubscriptionPlanApiContract
{
    /**
     * Getting subscription plan based on given plan id.
     * 
     * @param string $plan_id
     * @return SubscriptionPlanContract|null Null if not found.
     */
    public function find(string $plan_id): ?SubscriptionPlanContract;
}