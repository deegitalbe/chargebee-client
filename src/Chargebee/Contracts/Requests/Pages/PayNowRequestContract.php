<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface PayNowRequestContract extends ApiRequestContract
{
    /**
     * Setting related customer.
     * 
     * @param string $customer_id
     * @return static
     */
    public function customer(string $customer_id): PayNowRequestContract;

    /**
     * Setting redirect url after success.
     * 
     * @param string $successUrl
     * @return static
     */
    public function redirectTo(string $successUrl): PayNowRequestContract;
}