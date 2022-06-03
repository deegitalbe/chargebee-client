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
        return $this->request ?? $this->request = $this->generateRequest();
    }

    /**
     * Generating request.
     * 
     * @return RequestContract
     */
    protected function generateRequest(): RequestContract
    {
        return $this->build(app()->make(RequestContract::class));
    }

    /**
     * Building a fresh request.
     * 
     * @param RequestContract $request
     * @return RequestContract
     */
    abstract protected function build(RequestContract $request): RequestContract;
}