<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface UpdateRequestContract extends ApiRequestContract
{
  /**
     * Setting customer to work with.
     * 
     * @param string $customerId
     * @return static
     */
    public function setCustomer(string $customerId): UpdateRequestContract;

    /**
     * Setting related vat number.
     * 
     * @param string $locale
     * @return static
     */
    public function setLocale(string $locale): UpdateRequestContract;
}