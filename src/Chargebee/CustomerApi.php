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
     * Creating given customer.
     * 
     * @param CustomerContract $customer
     * @return CustomerContract|null Null if error.
     */
    public function store(CustomerContract $customer): ?CustomerContract
    {
        $request = app()->make(RequestContract::class)
            ->setUrl("/")
            ->setVerb('POST')
            ->addQuery([
                'first_name' => $customer->getFirstName(),
                'last_name' => $customer->getLastName(),
                'email' => $customer->getEmail(),
            ]);

        $response = $this->client->try($request, "Could not create customer.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $this->toCustomer($response->response()->get());
    }

    /**
     * Merging two customers with one another.
     * 
     * @param CustomerContract $from
     * @param CustomerContract $to
     * @return CustomerContract|null
     */
    public function merge(CustomerContract $from, CustomerContract $to): ?CustomerContract
    {
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);
        $request->setVerb("POST")
            ->setUrl("merge")
            ->addQuery([
                "from_customer_id" => $from->getId(),
                "to_customer_id" => $to->getId()
            ]);
        
        $response = $this->client->try($request, "Could not merge customers.");

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