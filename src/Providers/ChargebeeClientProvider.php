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
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\InvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\PageApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\PayNowRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\CustomerApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\SubscriptionApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionPlanApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\InvoiceApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\PageApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\TrustupVersionedPackage\Contracts\VersionedPackageCheckerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Credential\SubscriptionPlanApiCredential;
use Deegitalbe\ChargebeeClient\Chargebee\CustomerInvoiceApi;
use Deegitalbe\ChargebeeClient\Chargebee\InvoiceApi;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Invoice;
use Deegitalbe\ChargebeeClient\Chargebee\PageApi;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\CustomerInvoices\CustomerInvoiceRequest;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\invoices\InvoiceListRequest;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\Pages\PayNowRequest;
use Deegitalbe\ChargebeeClient\Chargebee\SubscriptionInvoiceApi;
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
        $this->app->bind(InvoiceContract::class, Invoice::class);

        // Requests
        $this->app->bind(InvoiceListRequestContract::class, InvoiceListRequest::class);
        $this->app->bind(PayNowRequestContract::class, PayNowRequest::class);

        // Customer API
        $this->app->bind(CustomerApiContract::class, function($app) {
            return new CustomerApi(
                $app->make(ClientContract::class)
                ->setCredential(new CustomerApiCredential)
            );
        });

        // Page API
        $this->app->bind(PageApiContract::class, function($app) {
            return new PageApi(
                $app->make(ClientContract::class)
                    ->setCredential(new PageApiCredential)
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

        // Invoices API
        $this->app->bind(InvoiceApiContract::class, function($app) {
            return new InvoiceApi(
                $app->make(ClientContract::class)
                    ->setCredential(new InvoiceApiCredential)
            );
        });

        // Customer invoices API
        $this->app->bind(CustomerInvoiceApiContract::class, function($app) {
            return new CustomerInvoiceApi(
                $app->make(ClientContract::class)
                    ->setCredential(new InvoiceApiCredential),
                $app->make(InvoiceApiContract::class)
            );
        });

        // Subscription invoices API
        $this->app->bind(SubscriptionInvoiceApiContract::class, function($app) {
            return new SubscriptionInvoiceApi(
                $app->make(ClientContract::class)
                    ->setCredential(new InvoiceApiCredential),
                $app->make(InvoiceApiContract::class)
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