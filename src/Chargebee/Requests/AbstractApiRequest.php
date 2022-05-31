<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests;

use Henrotaym\LaravelApiClient\Contracts\RequestContract;

abstract class AbstractApiRequest
{
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
    abstract protected function buildRequest(): RequestContract;
}