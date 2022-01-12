<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionPlanApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

/**
 * Subscription plan repository.
 */
class SubscriptionPlanApi implements SubscriptionPlanApiContract
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
     * Getting subscription plan based on given plan id.
     * 
     * @param string $plan_id
     * @return SubscriptionPlanContract|null Null if not found.
     */
    public function find(string $plan_id): ?SubscriptionPlanContract
    {
        $request = app()->make(RequestContract::class)
            ->setVerb('GET')
            ->setUrl($plan_id);

        $response = $this->client->try($request, "Could not find subscription plan.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toPlan($response->response()->get());
    }

    /**
     * Transforming raw customer sent back by api.
     * 
     * @param stdClass $raw_response
     * @return SubscriptionPlanContract
     */
    protected function toPlan(stdClass $raw_response): SubscriptionPlanContract
    {
        return app()->make(SubscriptionPlanContract::class)
            ->setAttributes($raw_response);
    }
}