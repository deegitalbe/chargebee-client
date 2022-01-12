<?php
namespace Deegitalbe\TrustupProAppCommon\Tests\Unit;

use Illuminate\Support\Facades\Log;
use Deegitalbe\ChargebeeClient\Tests\TestCase;
use Deegitalbe\TrustupProAppCommon\Facades\Package;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Subscription;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\TrustupProAppCommon\Exceptions\AdminAppApi\GetAppsException;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\SubscriptionPlanApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Deegitalbe\TrustupVersionedPackage\Contracts\VersionedPackageCheckerContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function returning_true()
    {
        $this->assertTrue(true);
    }
}