<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\PageApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\ManagePaymentMethodRequestContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;

class PageApiTest extends TestCase
{
    /** @test */
    public function it_can_generate_manage_payment_method_url()
    {
        /** @var PageApiContract */
        $pageApi = app()->make(PageApiContract::class);

        /** @var ManagePaymentMethodRequestContract */
        $request = app()->make(ManagePaymentMethodRequestContract::class);
        $request->customer('AzyjngVDkQvEQ5TmD')
            ->redirectTo('https://trustup.dev/success');

        $url = $pageApi->managePaymentMethod($request);

        $this->assertNotNull($url);
        $this->assertStringContainsString('chargebee.com', $url);
    }
}
