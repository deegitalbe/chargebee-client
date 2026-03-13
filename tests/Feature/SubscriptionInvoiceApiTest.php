<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionInvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class SubscriptionInvoiceApiTest extends TestCase
{
    /** @test */
    public function it_can_get_late_invoice_count_for_subscription()
    {
        /** @var SubscriptionInvoiceApiContract */
        $subscriptionInvoiceApi = app()->make(SubscriptionInvoiceApiContract::class);

        /** @var SubscriptionContract */
        $subscription = app()->make(SubscriptionContract::class);
        $subscription->setId('Azz0HOVDkQvTQ5Teu');

        $subscriptionInvoiceApi->setSubscription($subscription);
        $count = $subscriptionInvoiceApi->lateCount();

        $this->assertIsInt($count);
    }

    /** @test */
    public function it_can_get_late_invoices_for_subscription()
    {
        /** @var SubscriptionInvoiceApiContract */
        $subscriptionInvoiceApi = app()->make(SubscriptionInvoiceApiContract::class);

        /** @var SubscriptionContract */
        $subscription = app()->make(SubscriptionContract::class);
        $subscription->setId('Azz0HOVDkQvTQ5Teu');

        $subscriptionInvoiceApi->setSubscription($subscription);
        $lateInvoices = $subscriptionInvoiceApi->late();

        $this->assertNotNull($lateInvoices);
    }
}
