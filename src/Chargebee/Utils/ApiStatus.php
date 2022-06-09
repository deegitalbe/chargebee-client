<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Utils;

use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Henrotaym\LaravelApiClient\Contracts\TryResponseContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Utils\ApiStatusContract;
use Deegitalbe\ChargebeeClient\Facades\Package;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

/**
 * Representing chargebee status.
 */
class ApiStatus implements ApiStatusContract
{
    /**
     * Underlying client.
     * 
     * @var ClientContract
     */
    protected $client;

    /**
     * Reponse sent back by API.
     * 
     * @var TryResponseContract|null
     */
    protected $response;

    /**
     * Instanciating instance
     * 
     * @param ClientContract $client
     * @return void
     */
    public function __construct(ClientContract $client)
    {
        $this->client = $client;
    }

    /**
     * Getting api response
     * 
     * @return TryResponseContract
     */
    public function getResponse(): TryResponseContract
    {
        if ($this->response):
            return $this->response;
        endif;

        $this->setResponse($this->getResponseFromApi());

        return $this->response;
    }

    /**
     * Getting response from api directly.
     * 
     * @return TryResponseContract
     */
    protected function getResponseFromApi(): TryResponseContract
    {
        /** @var RequestContract */
        $request = app()->make(RequestContract::class);
        $request->setVerb('GET')
            // Could be any resource url.
            ->setUrl('plans');

        return $this->client->try($request, "Having chargebee api rates troubles.");
    }

    /**
     * Setting response.
     * 
     * @param TryResponseContract|null $response
     * @return static
     */
    protected function setResponse(?TryResponseContract $response): self
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Telling is api is currently healthy for requests.
     * 
     * @return bool
     */
    public function isHealthy(): bool
    {
        return $this->getResponse()->ok()
            || $this->getResponse()->response()->response()->status() !== 429;
    }

    /**
     * Telling how lonng you should wait to perform your next request.
     * 
     * @return int|null Null if client being healthy.
     */
    public function waitUntil(): ?int
    {
        if ($this->isHealthy()):
            return null;
        endif;

        $wait = $this->getResponse()->response()->response()->header('Retry-After');

        return $wait ? (int) $wait
            : Package::getLimitResetDuration();
    }

    /**
     * Making sure instance is clean before making any new check.
     * 
     * @return static
     */
    public function fresh(): ApiStatusContract
    {
        return $this->setResponse(null);
    }
}