<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\PayNowRequestContract;

/**
 * Pages api.
 */
interface PageApiContract
{
    /**
     * Getting url allowing to pay invoices now.
     * 
     * @param PayNowRequestContract $request
     * @return string|null
     */
    public function payNow(PayNowRequestContract $request): ?string;
}