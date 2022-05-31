<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoicePayNowRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Illuminate\Support\Collection;

/**
 * Customer invoices repository.
 */
interface InvoiceApiContract
{
    /**
     * Getting invoices matching given request.
     * 
     * @param InvoiceListRequestContract $request
     * @return Collection|null
     */
    public function index(InvoiceListRequestContract $request): ?Collection;

    /**
     * Getting invoices matching given request.
     * 
     * @param InvoiceListRequestContract $request
     * @return InvoiceContract|null
     */
    public function first(InvoiceListRequestContract $request): ?InvoiceContract;
}