<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer\UpdateBillingInfoRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer\UpdateRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;

/**
 * Subscription repository.
 */
interface CustomerApiContract
{
    /**
     * Getting customer based on given customer id.
     * 
     * @param string $customer_id
     * @return CustomerContract|null Null if not found.
     */
    public function find(string $customer_id): ?CustomerContract;

    /**
     * Creating given customer.
     * 
     * @param CustomerContract $customer
     * @return CustomerContract|null Null if error.
     */
    public function store(CustomerContract $customer): ?CustomerContract;

    /**
     * Merging two customers with one another.
     * 
     * @param CustomerContract $from
     * @param CustomerContract $to
     * @return CustomerContract|null
     */
    public function merge(CustomerContract $from, CustomerContract $to): ?CustomerContract;

    /**
     * Updating customer billing info.
     * 
     * @param UpdateBillingInfoRequestContract $request
     * @return CustomerContract|null
     */
    public function updateBillingInfo(UpdateBillingInfoRequestContract $request): ?CustomerContract;

    /**
     * Updating customer.
     * 
     * @param UpdateRequestContract $request
     * @return CustomerContract|null
     */
    public function update(UpdateRequestContract $request): ?CustomerContract;
}