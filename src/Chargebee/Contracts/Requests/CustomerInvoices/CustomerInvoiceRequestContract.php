<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\CustomerInvoices;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;

interface CustomerInvoiceRequestContract
{
    /**
     * Setting related customer.
     * 
     * @param string $customer_id
     * @return static
     */
    public function customer(string $customer_id): CustomerInvoiceRequestContract;

    /**
     * Limiting to late invoices only
     * 
     * @return static
     */
    public function beingLate(): CustomerInvoiceRequestContract;
    
    /**
     * Ordering invoices by latest.
     * 
     * @return static
     */
    public function latest(): CustomerInvoiceRequestContract;
    
    /**
     * Limiting invoices count
     * 
     * @param int|null $limit
     * @return static
     */
    public function limit(?int $limit): CustomerInvoiceRequestContract;
    
    /**
     * Setting request offset.
     * 
     * @param string|null $offset
     */
    public function offset(?string $offset): CustomerInvoiceRequestContract;
    
    /**
     * Getting request to execute.
     * 
     * @return RequestContract
     */
    public function get(): RequestContract;
}