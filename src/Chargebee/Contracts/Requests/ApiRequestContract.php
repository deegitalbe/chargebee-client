<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;

interface ApiRequestContract
{
    /**
     * Getting request to execute.
     * 
     * @return RequestContract
     */
    public function get(): RequestContract;
}