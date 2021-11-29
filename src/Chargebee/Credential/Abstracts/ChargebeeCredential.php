<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Credential\Abstracts;

use Henrotaym\LaravelApiClient\JsonCredential;
use Deegitalbe\ChargebeeClient\Facades\Package;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Henrotaym\LaravelApiClient\Contracts\CredentialContract;

/**
 * Chargebee credential setting up request to communicate with chargebee API.
 */
abstract class ChargebeeCredential extends JsonCredential
{
    public function prepare(RequestContract &$request)
    {
        parent::prepare($request);
        $request
            ->setBaseUrl($this->getUrl())
            ->setBasicAuth(Package::getSecret());
    }

    /**
     * Getting url related to this credential
     * 
     * @return string
     */
    abstract protected function getUrl(): string;
}