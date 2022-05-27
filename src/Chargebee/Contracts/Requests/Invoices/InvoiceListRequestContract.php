<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;

interface InvoiceListRequestContract
{
    /**
     * Setting related customer.
     * 
     * @param string $customer_id
     * @return static
     */
    public function customer(string $customer_id): InvoiceListRequestContract;

    /**
     * Setting related subscription.
     * 
     * @param string $customer_id
     * @return static
     */
    public function subscription(string $subscription_id): InvoiceListRequestContract;

    /**
     * Limiting to late invoices only.
     * 
     * @return static
     */
    public function beingLate(): InvoiceListRequestContract;
    
    /**
     * Ordering invoices by latest.
     * 
     * @return static
     */
    public function latest(): InvoiceListRequestContract;

    /**
     * Ordering invoices by latest.
     * 
     * @return static
     */
    public function oldest(): InvoiceListRequestContract;
    
    /**
     * Limiting invoices count.
     * 
     * @param int|null $limit
     * @return static
     */
    public function limit(?int $limit): InvoiceListRequestContract;
    
    /**
     * Setting request offset.
     * 
     * @param string|null $offset
     */
    public function offset(?string $offset): InvoiceListRequestContract;
    
    /**
     * Getting request to execute.
     * 
     * @return RequestContract
     */
    public function get(): RequestContract;
}