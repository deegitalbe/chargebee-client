<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\PauseRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\ResumeRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\UpdateRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class SubscriptionApiWriteTest extends TestCase
{
    /** @test */
    public function it_can_create_a_subscription()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        /** @var CustomerContract */
        $customer = app()->make(CustomerContract::class);
        $customer->setFirstName('SubTest')
            ->setLastName('PhpUnit')
            ->setEmail('sub-test-phpunit@trustup.dev')
            ->setLocale('fr');

        /** @var SubscriptionPlanContract */
        $plan = app()->make(SubscriptionPlanContract::class);
        $plan->setId('worksite-subscription-enterprise-monthly')
            ->setTrialDuration(1);

        $subscription = $subscriptionApi->create($plan, $customer);

        $this->assertNotNull($subscription);
        $this->assertInstanceOf(SubscriptionContract::class, $subscription);
        $this->assertNotEmpty($subscription->getId());
        $this->assertEquals('in_trial', $subscription->getStatus());
    }

    /** @test */
    public function it_can_cancel_a_subscription_now()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        /** @var CustomerContract */
        $customer = app()->make(CustomerContract::class);
        $customer->setFirstName('CancelNow')
            ->setLastName('PhpUnit')
            ->setEmail('cancel-now-phpunit@trustup.dev')
            ->setLocale('fr');

        /** @var SubscriptionPlanContract */
        $plan = app()->make(SubscriptionPlanContract::class);
        $plan->setId('worksite-subscription-enterprise-monthly')
            ->setTrialDuration(1);

        $subscription = $subscriptionApi->create($plan, $customer);
        $this->assertNotNull($subscription);

        $cancelled = $subscriptionApi->cancelNow($subscription);

        $this->assertNotNull($cancelled);
        $this->assertEquals('cancelled', $cancelled->getStatus());
    }

    /** @test */
    public function it_can_cancel_at_terms_an_active_subscription()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        // Use existing active subscription
        $subscription = $subscriptionApi->find('Azz0HOVDkQvTQ5Teu');
        $this->assertNotNull($subscription);
        $this->assertEquals('active', $subscription->getStatus());

        $cancelled = $subscriptionApi->cancelAtTerms($subscription);

        $this->assertNotNull($cancelled);
        $this->assertEquals('non_renewing', $cancelled->getStatus());

        // Reactivate to restore state
        $reactivated = $subscriptionApi->reactivate($cancelled);
        $this->assertNotNull($reactivated);
    }

    /** @test */
    public function it_can_reactivate_a_non_renewing_subscription()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        // Use existing active subscription
        $subscription = $subscriptionApi->find('Azz0HOVDkQvTQ5Teu');
        $this->assertNotNull($subscription);

        // Cancel at terms to get non_renewing state
        $cancelled = $subscriptionApi->cancelAtTerms($subscription);
        $this->assertNotNull($cancelled);
        $this->assertEquals('non_renewing', $cancelled->getStatus());

        // Reactivate
        $reactivated = $subscriptionApi->reactivate($cancelled);

        $this->assertNotNull($reactivated);
        $this->assertEquals('active', $reactivated->getStatus());
    }

    /** @test */
    public function it_can_pause_and_resume_an_active_subscription()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        // Use existing active subscription
        $subscription = $subscriptionApi->find('Azz0HOVDkQvTQ5Teu');
        $this->assertNotNull($subscription);
        $this->assertEquals('active', $subscription->getStatus());

        // Pause
        /** @var PauseRequestContract */
        $pauseRequest = app()->make(PauseRequestContract::class);
        $pauseRequest->setSubscription($subscription->getId())
            ->immediately()
            ->keepUnbilledCharges();

        $paused = $subscriptionApi->pause($pauseRequest);

        $this->assertNotNull($paused);
        $this->assertEquals('paused', $paused->getStatus());

        // Resume
        /** @var ResumeRequestContract */
        $resumeRequest = app()->make(ResumeRequestContract::class);
        $resumeRequest->setSubscription($paused->getId())
            ->immediately()
            ->keepUnpaidInvoices();

        $resumed = $subscriptionApi->resume($resumeRequest);

        $this->assertNotNull($resumed);
        $this->assertEquals('active', $resumed->getStatus());
    }

    /** @test */
    public function it_can_update_a_subscription_plan()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        $subscription = $subscriptionApi->find('Azz0HOVDkQvTQ5Teu');
        $this->assertNotNull($subscription);

        /** @var UpdateRequestContract */
        $updateRequest = app()->make(UpdateRequestContract::class);
        $updateRequest->setSubscription($subscription->getId())
            ->setPlan('worksite-subscription-enterprise-monthly');

        $updated = $subscriptionApi->update($updateRequest);

        $this->assertNotNull($updated);
        $this->assertEquals($subscription->getId(), $updated->getId());
    }

    /** @test */
    public function it_can_end_trial_now()
    {
        /** @var SubscriptionApiContract */
        $subscriptionApi = app()->make(SubscriptionApiContract::class);

        /** @var CustomerContract */
        $customer = app()->make(CustomerContract::class);
        $customer->setFirstName('EndTrial')
            ->setLastName('PhpUnit')
            ->setEmail('end-trial-phpunit@trustup.dev')
            ->setLocale('fr');

        /** @var SubscriptionPlanContract */
        $plan = app()->make(SubscriptionPlanContract::class);
        $plan->setId('worksite-subscription-enterprise-monthly')
            ->setTrialDuration(30);

        $subscription = $subscriptionApi->create($plan, $customer);
        $this->assertNotNull($subscription);
        $this->assertEquals('in_trial', $subscription->getStatus());

        $ended = $subscriptionApi->endTrialNow($subscription);

        $this->assertNotNull($ended);
    }
}
