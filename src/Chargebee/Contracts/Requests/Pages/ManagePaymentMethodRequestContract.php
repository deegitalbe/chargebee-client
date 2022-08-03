<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface ManagePaymentMethodRequestContract extends ApiRequestContract
{
    /**
     * Setting related customer.
     * 
     * @param string $customerId
     * @return static
     */
    public function customer(string $customerId): ManagePaymentMethodRequestContract;

    /**
     * Setting redirect url after success.
     * 
     * @param string $successUrl
     * @return static
     */
    public function redirectTo(string $successUrl): ManagePaymentMethodRequestContract;
}