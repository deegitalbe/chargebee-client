<?php
namespace Deegitalbe\ChargebeeClient\Providers;

use Deegitalbe\ChargebeeClient\Facades\Package;
use Deegitalbe\ChargebeeClient\Chargebee\CustomerApi;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Customer;
use Deegitalbe\ChargebeeClient\Chargebee\SubscriptionApi;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Subscription;
use Deegitalbe\ChargebeeClient\Chargebee\SubscriptionPlanApi;
use Deegitalbe\ChargebeeClient\Chargebee\Models\SubscriptionPlan;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\CustomerApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\SubscriptionApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionPlanApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\TrustupVersionedPackage\Contracts\VersionedPackageCheckerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\SubscriptionPlanApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;
use Deegitalbe\ChargebeeClient\Package as UnderlyingPackage;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;

/**
 * Chargebee client package service provider.
 */
class ChargebeeClientProvider extends VersionablePackageServiceProvider
{
    public static function getPackageClass(): string
    {
        return UnderlyingPackage::class;
    }

    protected function addToRegister(): void
    {
        $this->registerChargebeeDetails();
    }

    protected function addToBoot(): void
    {
        $this->registerPackageAsVersioned();
    }

    /**
     * Registering chargebee and related details.
     * 
     * @return self
     */
    public function registerChargebeeDetails(): self
    {
        // Models
        $this->app->bind(CustomerContract::class, Customer::class);
        $this->app->bind(SubscriptionContract::class, Subscription::class);
        $this->app->bind(SubscriptionPlanContract::class, SubscriptionPlan::class);

        // Customer API
        $this->app->bind(CustomerApiContract::class, function($app) {
            return new CustomerApi(
                $app->make(ClientContract::class)
                ->setCredential(new CustomerApiCredential)
            );
        });
        
        // Subscription API
        $this->app->bind(SubscriptionApiContract::class, function($app) {
            return new SubscriptionApi(
                $app->make(ClientContract::class)
                    ->setCredential(new SubscriptionApiCredential)
            );
        });

        // Subscription plan API
        $this->app->bind(SubscriptionPlanApiContract::class, function($app) {
            return new SubscriptionPlanApi(
                $app->make(ClientContract::class)
                    ->setCredential(new SubscriptionPlanApiCredential)
            );
        });

        return $this;
    }

    /**
     * Registering package to versioned package checker.
     * 
     * @return self
     */
    protected function registerPackageAsVersioned(): self
    {
        app()->make(VersionedPackageCheckerContract::class)
            ->addPackage(Package::getFacadeRoot());
        
        return $this;
    }
}