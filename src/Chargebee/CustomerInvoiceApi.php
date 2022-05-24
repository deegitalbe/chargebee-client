<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\CustomerInvoices\CustomerInvoiceRequestContract;
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
            $offset = $this->handleLateRequest(
                $this->lateRequest()
                    ->customer($customer_id)
                    ->offset($offset)
                    ->get(),
                $invoices
            );
        } while ($offset);

        return is_null($offset) ? null
            : $invoices;
    }

    /**
     * Creating late request based on given parameters.
     * 
     * @param string $customer_id
     * @param string|null $offset Offset to get next invoices.
     * @return CustomerInvoiceRequestContract
     */
    protected function lateRequest(): CustomerInvoiceRequestContract
    {
        /** @var CustomerInvoiceRequestContract */
        $request = app()->make(CustomerInvoiceRequestContract::class);

        return $request->beingLate()
            ->latest()
            ->limit(100);
    }

    /**
     * Getting last invoice related to customer id.
     * 
     * @return InvoiceContract|null
     */
    public function last(string $customer_id): ?InvoiceContract
    {
        $response = $this->client->try(
            $this->lastRequest()->customer($customer_id)->get(), 
            "Could not retrieve last invoice for customer."
        );

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        $invoices = $response->response()->get()->list;

        if (count($invoices) === 0):
            return null;
        endif;

        return $this->toInvoice($invoices[0]);
    }

    /**
     * Getting last late invoice related to customer id.
     * 
     * @return InvoiceContract|null
     */
    public function lastLate(string $customer_id): ?InvoiceContract
    {
        $response = $this->client->try(
            $this->lastRequest()->customer($customer_id)->beingLate()->get(),
            "Could not retrieve last late invoice for customer."
        );

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        $invoices = $response->response()->get()->list;

        if (count($invoices) === 0):
            return null;
        endif;

        return $this->toInvoice($invoices[0]);
    }

    protected function lastRequest(): CustomerInvoiceRequestContract
    {
        /** @var CustomerInvoiceRequestContract */
        $request = app()->make(CustomerInvoiceRequestContract::class);

        return $request->latest()->limit(1);
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