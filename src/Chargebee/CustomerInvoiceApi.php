<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Illuminate\Support\Collection;

/**
 * Subscription repository.
 */
class CustomerInvoiceApi implements CustomerInvoiceApiContract
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
     * Getting late invoices count for given customer.
     * 
     * @param string $customer_id
     * @return int|null Null if not found.
     */
    public function lateCount(string $customer_id): ?int
    {
        return optional($this->late($customer_id))->count();
    }

    /**
     * Getting late invoices for given customer.
     * 
     * @param string $customer_id
     * @return Collection|null Null if error.
     */
    public function late(string $customer_id): ?Collection
    {
        $offset = null;
        $invoices = collect();

        do {
            $offset = $this->handleLateRequest($this->lateRequest($customer_id, $offset), $invoices);
        } while ($offset);

        return is_null($offset) ? null
            : $invoices;
    }

    /**
     * Creating late request based on given parameters.
     * 
     * @param string $customer_id
     * @param string|null $offset Offset to get next invoices.
     * @return RequestContract
     */
    protected function lateRequest(string $customer_id, ?string $offset = null): RequestContract
    {
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);

        return $request->setUrl('/')
            ->setVerb('GET')
            ->addQuery(array_filter([
                'customer_id[is]' => $customer_id,
                'status[in]' => "[" . join(',', app()->make(InvoiceContract::class)::lateStatuses()) . "]",
                'offset' => $offset,
                'limit' => 100
            ]));
    }

    /**
     * Handling given late request.
     * 
     * @param RequestContract $request Late request.
     * @param Collection $invoices Pushing found invoices to this collection.
     * @return string|null If null, request failed, if empty no more results, next offset otherwise.
     */
    protected function handleLateRequest(RequestContract $request, Collection &$invoices): ?string
    {
        $response = $this->client->try($request, "Could not retrieve late invoices for customer.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        $data = $response->response()->get();

        $invoices->push(...collect($data->list)
            ->map(function($invoice) {
                return $this->toInvoice($invoice);
            })
        );
        
        return $data->next_offset ?? '';
    }

    /**
     * Transforming raw invoice sent back by api.
     * 
     * @param stdClass $raw_response
     * @return InvoiceContract
     */
    protected function toInvoice(stdClass $raw_response): InvoiceContract
    {
        return app()->make(InvoiceContract::class)
            ->setAttributes($raw_response);
    }
}