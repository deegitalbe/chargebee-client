<?php
namespace Deegitalbe\ChargebeeClient\Tests;

use Deegitalbe\ChargebeeClient\Package;
use Henrotaym\LaravelApiClient\Providers\ClientServiceProvider;
use Deegitalbe\ChargebeeClient\Providers\ChargebeeClientProvider;
use Deegitalbe\TrustupVersionedPackage\Providers\TrustupVersionedPackageServiceProvider;
use Henrotaym\LaravelPackageVersioning\Testing\VersionablePackageTestCase;

class TestCase extends VersionablePackageTestCase
{
    public static function getPackageClass(): string
    {
        return Package::class;
    }

    public function getServiceProviders(): array
    {
        return [
            TrustupVersionedPackageServiceProvider::class,
            ClientServiceProvider::class,
            ChargebeeClientProvider::class
        ];
    }
}