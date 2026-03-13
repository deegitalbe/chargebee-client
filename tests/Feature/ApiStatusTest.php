<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Utils\ApiStatusContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class ApiStatusTest extends TestCase
{
    /** @test */
    public function it_can_check_api_health()
    {
        /** @var ApiStatusContract */
        $apiStatus = app()->make(ApiStatusContract::class);

        $this->assertTrue($apiStatus->isHealthy());
        $this->assertNull($apiStatus->waitUntil());
    }

    /** @test */
    public function it_can_execute_callback_when_healthy()
    {
        /** @var ApiStatusContract */
        $apiStatus = app()->make(ApiStatusContract::class);

        $result = $apiStatus->whenHealthy(fn () => 'ok');

        $this->assertEquals('ok', $result);
    }
}
