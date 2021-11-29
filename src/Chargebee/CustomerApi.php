<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;

/**
 * Subscription repository.
 */
class CustomerApi implements CustomerApiContract
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
     * Getting customer based on given customer id.
     * 
     * @param string $customer_id
     * @return CustomerContract|null Null if not found.
     */
    public function find(string $customer_id): ?CustomerContract
    {
        $request = app()->make(RequestContract::class)
            ->setVerb('GET')
            ->setUrl($customer_id);

        $response = $this->client->try($request, "Could not find customer.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toCustomer($response->response()->get());
    }

    /**
     * Transforming raw customer sent back by api.
     * 
     * @param stdClass $raw_response
     * @return CustomerContract
     */
    protected function toCustomer(stdClass $raw_response): CustomerContract
    {
        return app()->make(CustomerContract::class)
            ->setAttributes($raw_response);
    }
}