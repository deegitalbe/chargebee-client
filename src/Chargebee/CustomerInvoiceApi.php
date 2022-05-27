<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\InvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;
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
     * Invoice api.
     * 
     * @var InvoiceApiContract
     */
    protected $invoiceApi;

    /**
     * Constructor.
     * 
     * @param ClientContract
     */
    public function __construct(
        ClientContract $client,
        InvoiceApiContract $invoiceApi
    ) {
        $this->client = $client;
        $this->invoiceApi = $invoiceApi;
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
        return $this->invoiceApi->index($this->lateRequest($customer_id)->latest());
    }

    /**
     * Creating late request based on given parameters.
     * 
     * @param string $customer_id
     * @return InvoiceListRequestContract
     */
    protected function lateRequest(string $customer_id): InvoiceListRequestContract
    {
        /** @var InvoiceListRequestContract */
        $request = app()->make(InvoiceListRequestContract::class);

        return $request->beingLate()->customer($customer_id);
    }

    /**
     * Getting last late invoice related to customer id.
     * 
     * @param string $customer_id
     * @return InvoiceContract|null
     */
    public function firstLate(string $customer_id): ?InvoiceContract
    {
        return $this->invoiceApi->first($this->lateRequest($customer_id)->oldest());
    }
}