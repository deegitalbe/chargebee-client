<?php
namespace Deegitalbe\ChargebeeClient\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Henrotaym\LaravelHelpers\Providers\HelperServiceProvider;
use Henrotaym\LaravelApiClient\Providers\ClientServiceProvider;
use Deegitalbe\ChargebeeClient\Providers\ChargebeeClientProvider;
use Deegitalbe\TrustupVersionedPackage\Providers\TrustupVersionedPackageServiceProvider;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            TrustupVersionedPackageServiceProvider::class,
            HelperServiceProvider::class,
            ClientServiceProvider::class,
            ChargebeeClientProvider::class
        ];
    }
}