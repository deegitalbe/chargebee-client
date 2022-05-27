<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\InvoiceApiContract;
use stdClass;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Illuminate\Support\Collection;

/**
 * Subscription repository.
 */
class InvoiceApi implements InvoiceApiContract
{
    /**
     * CLient communicating with chargebee api.
     * 
     * @var ClientContract
     */
    protected $client;

    /**
     * Offset that will be used for next request.
     * 
     * @var string
     */
    protected $offset;

    /**
     * Current invoices.
     * 
     * @var Collection
     */
    protected $invoices;

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
     * Getting invoices matching given request.
     * 
     * @param InvoiceListRequestContract $request
     * @return Collection|null
     */
    public function index(InvoiceListRequestContract $request): ?Collection
    {
        $this->reset();

        do {
            $success = $this->indexRequest($request->limit(100));
        } while ($success && $this->offset);

        return $success ? $this->invoices
            : null;
    }

    /**
     * Getting invoices matching given request.
     * 
     * @param InvoiceListRequestContract $request
     * @return InvoiceContract|null
     */
    public function first(InvoiceListRequestContract $request): ?InvoiceContract
    {
        $this->reset()->indexRequest($request->limit(1));
        
        return $this->invoices->first();
    }

    /**
     * Resetting client.
     * 
     * @return static.
     */
    public function reset(): InvoiceApi
    {
        $this->invoices = collect();

        return $this->setOffset(null);
    }

    /**
     * Setting next request offset.
     * 
     * @param string|null $offset
     * @return static
     */
    protected function setOffset(?string $offset): InvoiceApi
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Handling given request.
     * 
     * @param InvoiceListRequestContract $request request.
     * @return bool Having more results to load.
     */
    protected function indexRequest(InvoiceListRequestContract $request): bool
    {
        $response = $this->client->try(
            $request->offset($this->offset)->get(),
            "Could not retrieve invoices."
        );

        if ($response->failed()):
            report($response->error());
            $this->setOffset(null);
            return false;
        endif;

        $data = $response->response()->get();

        $this->invoices->push(...collect($data->list)
            ->map(function($invoice) {
                return $this->toInvoice($invoice);
            })
        );

        $this->setOffset($data->next_offset ?? null);
        return true;
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