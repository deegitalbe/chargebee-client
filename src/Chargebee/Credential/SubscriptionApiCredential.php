<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Credential;

use Deegitalbe\ChargebeeClient\Facades\Package;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\Abstracts\ChargebeeCredential;

/**
 * Chargebee subscription credential setting up request to communicate with chargebee API.
 */
class SubscriptionApiCredential extends ChargebeeCredential
{
    protected function getUrl(): string
    {
        return Package::getUrl();
    }
}