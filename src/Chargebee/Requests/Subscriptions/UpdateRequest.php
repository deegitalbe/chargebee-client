<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Subscriptions;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\UpdateRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class UpdateRequest extends AbstractApiRequest implements UpdateRequestContract
{
     /**
     * Setting related subscription to pause.
     * 
     * @param string $subscriptionId
     * @return static
     */
    public function setSubscription(string $subscriptionId): UpdateRequestContract
    {
        $this->get()->setUrl("subscriptions/$subscriptionId");

        return $this;
    }

    /**
     * Setting related plan.
     * 
     * @param string $planId
     * @return static
     */
    public function setPlan(string $planId): UpdateRequestContract
    {
        $this->get()->addQuery(['plan_id' => $planId]);

        return $this;
    }

    /**
     * Telling if subscription should be reactivated if cancelled.
     * 
     * @return static
     */
    public function reactivate(bool $isReactivating): UpdateRequestContract
    {
        $this->get()->addQuery(['reactivate' => $isReactivating ? 'true' : 'false']);

        return $this;
    }

    protected function build(RequestContract $request): RequestContract
    {
        return $request->setVerb("POST");
    }
}