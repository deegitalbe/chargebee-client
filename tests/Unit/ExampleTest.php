<?php
namespace Deegitalbe\TrustupProAppCommon\Tests\Unit;

use Deegitalbe\ChargebeeClient\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionInvoiceApiContract;

class ExampleTest extends TestCase
{
    use InstallPackageTest;

    /**
     * @test
     */
    public function returning_true()
    {
        // /** @var SubscriptionInvoiceApiContract */
        // $service = $this->app->make(SubscriptionInvoiceApiContract::class);
        // $subscription = $this->app->make(SubscriptionApiContract::class)->find("AzqgtCRyIzCRUFS");
        // dd(
        //     $service->setSubscription($subscription)
        //         ->firstLate()
        //         ->getDueDate()
        // );
        
        $this->assertTrue(true);
    }
}