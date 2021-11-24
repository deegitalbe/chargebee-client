<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

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
}