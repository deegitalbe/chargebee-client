<?php
namespace Deegitalbe\TrustupProAppCommon\Tests\Unit;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\PageApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\PayNowRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\PauseRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\ResumeRequestContract;
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
        //     ($service->setSubscription($subscription)
        //         ->firstLate())
        //         // ->getDueDate()
        // );

        // /** @var PayNowRequestContract */
        // $request = $this->app->make(PayNowRequestContract::class);
        // $request->customer("16CHITRxLKtRP5AK")
        //     ->redirectTo('https://trustup.pro');

        // /** @var PageApiContract */
        // $api = $this->app->make(PageApiContract::class);
        // dd($api->payNow($request));

        // /** @var PauseRequestContract */
        // $request = $this->app->make(PauseRequestContract::class);
        // $request->setSubscription("AzqTzMSrkcwtVaU8")
        //     ->immediately()
        //     ->keepUnbilledCharges();

        // /** @var SubscriptionApiContract */
        // $api = $this->app->make(SubscriptionApiContract::class);
        // dd($api->pause($request));

        // /** @var ResumeRequestContract */
        // $request = $this->app->make(ResumeRequestContract::class);
        // $request->setSubscription("AzqTzMSrkcwtVaU8")
        //     ->immediately()
        //     ->keepUnpaidInvoices();

        // /** @var SubscriptionApiContract */
        // $api = $this->app->make(SubscriptionApiContract::class);
        // dd($api->resume($request));
        
        $this->assertTrue(true);
    }
}