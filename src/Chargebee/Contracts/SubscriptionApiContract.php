<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

/**
 * Subscription repository.
 */
interface SubscriptionApiContract
{
    /**
     * Finding subscription based on given id.
     * 
     * @param string $subscription_id
     * @return SubscriptionContract|null Null if not found.
     */
    public function find(string $subscription_id): ?SubscriptionContract;

    /**
     * Creating a subscription for given customer and plan.
     * 
     * @param SubscriptionPlanContract $plan
     * @param CustomerContract $customer
     * @return SubscriptionContract|null Null if any error.
     */
    public function create(SubscriptionPlanContract $plan, CustomerContract $customer): ?SubscriptionContract;

    /**
     * Cancelling subscription at terms.
     * 
     * @param SubscriptionContract $subscription
     * @return SubscriptionContract|null Null if error.
     */
    public function cancelAtTerms(SubscriptionContract $subscription): ?SubscriptionContract;

    /**
     * Cancelling subscription now.
     * 
     * @param SubscriptionContract $subscription
     * @return SubscriptionContract|null Null if error.
     */
    public function cancelNow(SubscriptionContract $subscription): ?SubscriptionContract;

    /**
     * Reactivate subscription.
     * 
     * @param SubscriptionContract $subscription
     * @return SubscriptionContract|null Null if error.
     */
    public function reactivate(SubscriptionContract $subscription): ?SubscriptionContract;
}