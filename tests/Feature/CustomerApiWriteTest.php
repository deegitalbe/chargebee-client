<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer\UpdateBillingInfoRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer\UpdateRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class CustomerApiWriteTest extends TestCase
{
    /** @test */
    public function it_can_store_a_new_customer()
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        /** @var CustomerContract */
        $customer = app()->make(CustomerContract::class);
        $customer->setFirstName('Test')
            ->setLastName('PhpUnit')
            ->setEmail('test-phpunit@trustup.dev')
            ->setLocale('fr');

        $created = $customerApi->store($customer);

        $this->assertNotNull($created);
        $this->assertInstanceOf(CustomerContract::class, $created);
        $this->assertNotNull($created->getId());
        $this->assertEquals('Test', $created->getFirstName());
        $this->assertEquals('PhpUnit', $created->getLastName());
        $this->assertEquals('test-phpunit@trustup.dev', $created->getEmail());
    }

    /** @test */
    public function it_can_update_customer_locale()
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        /** @var UpdateRequestContract */
        $request = app()->make(UpdateRequestContract::class);
        $request->setCustomer('AzyjngVDkQvEQ5TmD')
            ->setLocale('nl');

        $updated = $customerApi->update($request);

        $this->assertNotNull($updated);
        $this->assertEquals('AzyjngVDkQvEQ5TmD', $updated->getId());
        $this->assertEquals('nl', $updated->getLocale());

        // Restore original locale
        $request = app()->make(UpdateRequestContract::class);
        $request->setCustomer('AzyjngVDkQvEQ5TmD')
            ->setLocale('fr');
        $customerApi->update($request);
    }

    /** @test */
    public function it_can_update_customer_billing_info()
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        /** @var UpdateBillingInfoRequestContract */
        $request = app()->make(UpdateBillingInfoRequestContract::class);
        $request->setCustomer('AzyjngVDkQvEQ5TmD')
            ->setFirstName('Simon')
            ->setLastName('Refereebe')
            ->setEmail('simon.dejean+refereebe@trustup.group')
            ->setPhone('495316245')
            ->setCompany('Simon Referee BE')
            ->setStreetName('Rue Alfred Deponthière')
            ->setStreetNumber('46')
            ->setPostalCode('4431')
            ->setCity('Ans')
            ->setCountryCode('BE');

        $updated = $customerApi->updateBillingInfo($request);

        $this->assertNotNull($updated);
        $this->assertEquals('AzyjngVDkQvEQ5TmD', $updated->getId());
        $this->assertTrue($updated->isHavingBillingAddress());
    }

    /** @test */
    public function it_can_merge_two_customers()
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        // Create two customers to merge
        /** @var CustomerContract */
        $from = app()->make(CustomerContract::class);
        $from->setFirstName('MergeFrom')
            ->setLastName('Test')
            ->setEmail('merge-from@trustup.dev')
            ->setLocale('fr');
        $from = $customerApi->store($from);

        /** @var CustomerContract */
        $to = app()->make(CustomerContract::class);
        $to->setFirstName('MergeTo')
            ->setLastName('Test')
            ->setEmail('merge-to@trustup.dev')
            ->setLocale('fr');
        $to = $customerApi->store($to);

        $this->assertNotNull($from);
        $this->assertNotNull($to);

        $merged = $customerApi->merge($from, $to);

        $this->assertNotNull($merged);
        $this->assertEquals($to->getId(), $merged->getId());
    }
}
