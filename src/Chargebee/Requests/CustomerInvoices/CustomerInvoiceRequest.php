<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\CustomerInvoices;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\CustomerInvoices\CustomerInvoiceRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class CustomerInvoiceRequest implements CustomerInvoiceRequestContract
{
    /**
     * Related customer
     * 
     * @var RequestContract
     */
    protected $request;

    /**
     * Setting related customer.
     * 
     * @param string $customer_id
     * @return static
     */
    public function customer(string $customer_id): CustomerInvoiceRequestContract
    {
        $this->get()->addQuery(['customer_id[is]' => $customer_id]);

        return $this;
    }

    /**
     * Limiting to late invoices only
     * 
     * @return static
     */
    public function beingLate(): CustomerInvoiceRequestContract
    {
        $this->get()->addQuery([
            'status[in]' => "[" . join(',', app()->make(InvoiceContract::class)::lateStatuses()) . "]" 
        ]);

        return $this;
    }
    
    /**
     * Ordering invoices by latest.
     * 
     * @return static
     */
    public function latest(): CustomerInvoiceRequestContract
    {
        $this->get()->addQuery(['sort_by[desc]' => 'date']);

        return $this;
    }
    
    /**
     * Limiting invoices count
     * 
     * @param int|null $limit
     * @return static
     */
    public function limit(?int $limit): CustomerInvoiceRequestContract
    {
        $this->get()->addQuery(['limit' => $limit]);

        return $this;
    }
    
    /**
     * Setting request offset.
     * 
     * @param string|null $offset
     */
    public function offset(?string $offset): CustomerInvoiceRequestContract
    {
        $this->get()->addQuery(['offset' => $offset]);

        return $this;
    }
    
    /**
     * Getting request to execute.
     * 
     * @return RequestContract
     */
    public function get(): RequestContract
    {
        return $this->request ?? $this->request = $this->buildRequest();
    }

    /**
     * Building a fresh request.
     * 
     * @return RequestContract
     */
    protected function buildRequest(): RequestContract
    {
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);

        return $request->setUrl('/')
            ->setVerb('GET');
    }
}