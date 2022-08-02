<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface UpdateRequestContract extends ApiRequestContract
{
  /**
     * Setting related subscription to pause.
     * 
     * @param string $subscriptionId
     * @return static
     */
    public function setSubscription(string $subscriptionId): UpdateRequestContract;

    /**
     * Setting related plan.
     * 
     * @param string $planId
     * @return static
     */
    public function setPlan(string $planId): UpdateRequestContract;

    /**
     * Telling if subscription should be reactivated if cancelled.
     * 
     * @return static
     */
    public function reactivate(bool $isReactivating): UpdateRequestContract;
}