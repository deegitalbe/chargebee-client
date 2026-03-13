<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class CustomerApiFindTest extends TestCase
{
    /** @test */
    public function it_can_find_a_customer_by_id()
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        $customer = $customerApi->find('AzyjngVDkQvEQ5TmD');

        $this->assertNotNull($customer);
        $this->assertEquals('AzyjngVDkQvEQ5TmD', $customer->getId());
    }
}
