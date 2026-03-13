<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
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
        $this->assertInstanceOf(CustomerContract::class, $customer);
        $this->assertEquals('AzyjngVDkQvEQ5TmD', $customer->getId());
        $this->assertNotEmpty($customer->getFirstName());
        $this->assertNotEmpty($customer->getEmail());
    }

    /** @test */
    public function it_returns_null_for_unknown_customer()
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        $customer = $customerApi->find('non_existing_customer_id_12345');

        $this->assertNull($customer);
    }
}
