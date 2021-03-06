<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Illuminate\Support\Collection;

/**
 * Customer invoices repository.
 */
interface CustomerInvoiceApiContract
{
    /**
     * Getting late invoices count for given customer.
     * 
     * @param string $customer_id
     * @return int|null Null if not found.
     */
    public function lateCount(string $customer_id): ?int;

    /**
     * Getting late invoices for given customer.
     * 
     * @param string $customer_id
     * @return Collection|null Null if error.
     */
    public function late(string $customer_id): ?Collection;

    /**
     * Getting last late invoice related to customer id.
     * 
     * @param string|null $customer_id
     * @return InvoiceContract|null
     */
    public function firstLate(string $customer_id): ?InvoiceContract; 
}