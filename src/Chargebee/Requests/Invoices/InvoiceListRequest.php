<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Invoices;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class InvoiceListRequest extends AbstractApiRequest implements InvoiceListRequestContract
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
    public function customer(string $customer_id): InvoiceListRequestContract
    {
        $this->get()->addQuery(['customer_id[is]' => $customer_id]);

        return $this;
    }

    /**
     * Setting related subscription.
     * 
     * @param string $customer_id
     * @return static
     */
    public function subscription(string $subscription_id): InvoiceListRequestContract
    {
        $this->get()->addQuery(['subscription_id' => $subscription_id]);

        return $this;
    }

    /**
     * Limiting to late invoices only
     * 
     * @return static
     */
    public function beingLate(): InvoiceListRequestContract
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
    public function latest(): InvoiceListRequestContract
    {
        $this->get()->addQuery(['sort_by[desc]' => 'date']);

        return $this;
    }

    /**
     * Ordering invoices by oldest.
     * 
     * @return static
     */
    public function oldest(): InvoiceListRequestContract
    {
        $this->get()->addQuery(['sort_by[asc]' => 'date']);

        return $this;
    }
    
    /**
     * Limiting invoices count
     * 
     * @param int|null $limit
     * @return static
     */
    public function limit(?int $limit): InvoiceListRequestContract
    {
        $this->get()->addQuery(['limit' => $limit]);

        return $this;
    }
    
    /**
     * Setting request offset.
     * 
     * @param string|null $offset
     * @return static
     */
    public function offset(?string $offset): InvoiceListRequestContract
    {
        $this->get()->addQuery(['offset' => $offset]);

        return $this;
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