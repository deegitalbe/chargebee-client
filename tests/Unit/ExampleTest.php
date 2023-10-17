<?php
namespace Deegitalbe\TrustupProAppCommon\Tests\Unit;

use Deegitalbe\ChargebeeClient\Tests\TestCase;
use Deegitalbe\ChargebeeClient\Chargebee\Utils\ApiStatus;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\PageApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Utils\ApiStatusContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\PayNowRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\PauseRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\ResumeRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\PaymentMethodContract;

class ExampleTest extends TestCase
{
    use InstallPackageTest;

    /**
     * @test
     */
    public function parsing_pending_verification()
    {
        $attributes = json_decode(json_encode([
            "status" => "pending_verification"
        ]));

        $paymentMethod = app()->make(PaymentMethodContract::class);
        $paymentMethod->setAttributes($attributes);
        
        $this->assertTrue($paymentMethod->isPendingVerification());
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
        // dd($api->resume($request));*
        /** @var ApiStatus */
        // $service = $this->app->make(ApiStatusContract::class);

        // for ($i=0; $i < 1000; $i++) {
        //     $this->assertTrue($service->fresh()->isHealthy());
        // }
    }

    /**
     * @test
     */
    public function parsing_expired()
    {
        $attributes = json_decode(json_encode([
            "status" => "expiring"
        ]));

        $paymentMethod = app()->make(PaymentMethodContract::class);
        $paymentMethod->setAttributes($attributes);
        
        $this->assertTrue($paymentMethod->isExpiring());
    }

    /**
     * @test
     */
    public function parsing_valid()
    {
        $attributes = json_decode(json_encode([
            "status" => "valid"
        ]));

        $paymentMethod = app()->make(PaymentMethodContract::class);
        $paymentMethod->setAttributes($attributes);
        
        $this->assertTrue($paymentMethod->isValid());
    }

    /**
     * @test
     */
    public function customer_telling_true_if_payment_method_valid()
    {
        $attributes = json_decode(json_encode([
            "customer" => [
                "payment_method" => [
                    "status" => "valid"
                ]
            ]
        ]));

        $customer = app()->make(CustomerContract::class);
        $customer->setAttributes($attributes);
        
        $this->assertTrue($customer->isChargeable());
    }

    /**
     * @test
     */
    public function customer_telling_true_if_payment_method_expiring()
    {
        $attributes = json_decode(json_encode([
            "customer" => [
                "payment_method" => [
                    "status" => "expiring"
                ]
            ]
        ]));

        $customer = app()->make(CustomerContract::class);
        $customer->setAttributes($attributes);
        
        $this->assertTrue($customer->isChargeable());
    }

    /**
     * @test
     */
    public function customer_telling_true_if_payment_method_pending_verification()
    {
        $attributes = json_decode(json_encode([
            "customer" => [
                "payment_method" => [
                    "status" => "pending_verification"
                ]
            ]
        ]));

        $customer = app()->make(CustomerContract::class);
        $customer->setAttributes($attributes);
        
        $this->assertTrue($customer->isChargeable());
    }

    /**
     * @test
     */
    public function customer_telling_true_if_payment_method_expired()
    {
        $attributes = json_decode(json_encode([
            "customer" => [
                "payment_method" => [
                    "status" => "expired"
                ]
            ]
        ]));

        $customer = app()->make(CustomerContract::class);
        $customer->setAttributes($attributes);
        
        $this->assertFalse($customer->isChargeable());
    }
}