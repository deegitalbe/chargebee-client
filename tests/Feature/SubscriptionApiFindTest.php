<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class SubscriptionApiFindTest extends TestCase
{
    /** @test */
    public function it_can_find_a_subscription_by_id()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        $subscription = $subscriptionApi->find('Azz0HOVDkQvTQ5Teu');

        $this->assertNotNull($subscription);
        $this->assertInstanceOf(SubscriptionContract::class, $subscription);
        $this->assertEquals('Azz0HOVDkQvTQ5Teu', $subscription->getId());
        $this->assertNotEmpty($subscription->getStatus());
    }

    /** @test */
    public function it_returns_null_for_unknown_subscription()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        $subscription = $subscriptionApi->find('non_existing_subscription_id_12345');

        $this->assertNull($subscription);
    }
}
