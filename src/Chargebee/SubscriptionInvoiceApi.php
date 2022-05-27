<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use stdClass;
use Illuminate\Support\Collection;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\InvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;

/**
 * Subscription invoice repository.
 */
class SubscriptionInvoiceApi implements SubscriptionInvoiceApiContract
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
     * Invoice api.
     * 
     * @var SubscriptionContract
     */
    protected $subscription;

    /**
     * Constructor.
     * 
     * @param InvoiceApiContract $invoiceApi
     * @param ClientContract $client
     */
    public function __construct(
        ClientContract $client,
        InvoiceApiContract $invoiceApi
    ) {
        $this->client = $client;
        $this->invoiceApi = $invoiceApi;
    }

    /**
     * Setting related subscription.
     * 
     * @param SubscriptionContract $subscription
     * @return static
     */
    public function setSubscription(SubscriptionContract $subscription): SubscriptionInvoiceApiContract
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * Getting late invoices count for given subscription.
     * 
     * @return int|null Null if not found.
     */
    public function lateCount(): ?int
    {
        return optional($this->late())->count();
    }

    /**
     * Getting late invoices for given subscription.
     * 
     * @return Collection|null Null if error.
     */
    public function late(): ?Collection
    {
        return $this->invoiceApi->index($this->lateRequest()->latest());
    }

    /**
     * Creating late request based on given parameters.
     * 
     * @return InvoiceListRequestContract
     */
    protected function lateRequest(): InvoiceListRequestContract
    {
        /** @var InvoiceListRequestContract */
        $request = app()->make(InvoiceListRequestContract::class);

        return $request->beingLate()->subscription($this->subscription->getId());
    }

    /**
     * Getting last late invoice related to subscription id.
     * 
     * @return InvoiceContract|null
     */
    public function firstLate(): ?InvoiceContract
    {
        return $this->invoiceApi->first($this->lateRequest()->oldest());
    }
}