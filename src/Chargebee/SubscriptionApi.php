<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\PauseRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\ResumeRequestContract;
use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

/**
 * Subscription repository.
 */
class SubscriptionApi implements SubscriptionApiContract
{
    /**
     * CLient communicating with chargebee api.
     * 
     * @var ClientContract
     */
    protected $client;

    /**
     * Constructor.
     * 
     * @param ClientContract
     */
    public function __construct(ClientContract $client)
    {
        $this->client = $client;
    }

    /**
     * Finding subscription based on given id.
     * 
     * @param string $subscription_id
     * @return SubscriptionContract|null Null if not found.
     */
    public function find(string $subscription_id): ?SubscriptionContract
    {
        $request = app()->make(RequestContract::class)
            ->setVerb('GET')
            ->setUrl("subscriptions/$subscription_id");
        
        $response = $this->client->try($request, "Could not find subscription.");

        if ($response->failed()):
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Creating a subscription for given customer and plan.
     * 
     * @param SubscriptionPlanContract $plan
     * @param CustomerContract $customer
     * @return SubscriptionContract|null Null if any error.
     */
    public function create(SubscriptionPlanContract $plan, CustomerContract $customer): ?SubscriptionContract
    {
        $request = app()->make(RequestContract::class)
            ->setVerb('POST')
            ->setUrl($this->getCreateUrl($customer))
            ->addQuery($this->getCreateParameters($plan, $customer));
        
        $response = $this->client->try($request, "Could not create subscription.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Getting create POST parameters for request.
     * 
     * @param SubscriptionPlanContract $plan
     * @param CustomerContract $customer
     * @return array
     */
    protected function getCreateParameters(SubscriptionPlanContract $plan, CustomerContract $customer): array
    {
        $parameters = [
            'plan_id' => $plan->getId(),
            'trial_end' => now()->addDays($plan->getTrialDuration())->timestamp,
            'auto_collection' => 'on'
        ];
        
        if (!$customer->isPersisted()):
            return array_merge($parameters, [
                'customer' => [
                    'first_name' => $customer->getFirstName(),
                    'last_name' => $customer->getLastName(),
                    'email' => $customer->getEmail()
                ],
                'billing_address' => [
                    'first_name' => $customer->getFirstName(),
                    'last_name' => $customer->getLastName()
                ]
            ]);
        endif;

        return $parameters;
    }

    /**
     * Getting create url for given customer.
     * 
     * @param CustomerContract $customer
     * @return stringS
     */
    protected function getCreateUrl(CustomerContract $customer): string
    {
        return $customer->isPersisted()
            ? "customers/{$customer->getId()}/subscriptions"
            : "subscriptions";
    }

    /**
     * Cancelling subscription at terms.
     * 
     * @param SubscriptionContract $subscription
     * @return SubscriptionContract|null Null if error.
     */
    public function cancelAtTerms(SubscriptionContract $subscription): ?SubscriptionContract
    {
        $request = $this->getCancelRequest($subscription)
            ->addQuery(['end_of_term' => "true"]);

        $response = $this->client->try($request, "Could not cancel subscription at terms.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Cancelling subscription now.
     * 
     * @param SubscriptionContract $subscription
     * @return SubscriptionContract|null Null if error.
     */
    public function cancelNow(SubscriptionContract $subscription): ?SubscriptionContract
    {
        $request = $this->getCancelRequest($subscription);

        $response = $this->client->try($request, "Could not cancel subscription immediately.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Making cancel request.
     * 
     * @param SubscriptionContract $subscription
     * @return RequestContract
     */
    protected function getCancelRequest(SubscriptionContract $subscription): RequestContract
    {
        return app()->make(RequestContract::class)
            ->setVerb('POST')
            ->setUrl("subscriptions/{$subscription->getId()}/cancel");
    }

    /**
     * Reactivate subscription.
     * 
     * @param SubscriptionContract $subscription
     * @return SubscriptionContract|null Null if error.
     */
    public function reactivate(SubscriptionContract $subscription): ?SubscriptionContract
    {
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);
        $request
            ->setVerb("POST")
            ->setUrl("subscriptions/{$subscription->getId()}/reactivate");

        $response = $this->client->try($request, "Could not reactivate chargebee subscription [{$subscription->getId()}]");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Pausing subscription.
     * 
     * @param PauseRequestContract $request
     * @return SubscriptionContract|null
     */
    public function pause(PauseRequestContract $request): ?SubscriptionContract
    {
        $response = $this->client->try($request->get(), "Could not pause subscription.");

        if ($response->failed()):
            dd($response->error()->context());
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Pausing subscription.
     * 
     * @param ResumeRequestContract $request
     * @return SubscriptionContract|null
     */
    public function resume(ResumeRequestContract $request): ?SubscriptionContract
    {
        $response = $this->client->try($request->get(), "Could not resume subscription.");

        if ($response->failed()):
            dd($response->error()->context());
            return null;
        endif;

        return $this->toSubscription($response->response()->get());
    }

    /**
     * Transforming raw subscription sent back by api.
     * 
     * @param stdClass $raw_response
     * @return SubscriptionContract
     */
    protected function toSubscription(stdClass $raw_response): SubscriptionContract
    {
        return app()->make(SubscriptionContract::class)
            ->setAttributes($raw_response);
    }
}