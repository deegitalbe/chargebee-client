<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Credential\Abstracts;

use Deegitalbe\ChargebeeClient\Facades\Package;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;
use Henrotaym\LaravelApiClient\Contracts\CredentialContract;

/**
 * Chargebee credential setting up request to communicate with chargebee API.
 */
abstract class ChargebeeCredential implements CredentialContract
{
    public function prepare(RequestContract &$request)
    {
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