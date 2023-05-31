<?php
namespace Deegitalbe\ChargebeeClient\Chargebee;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\PageApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\ManagePaymentMethodRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\PayNowRequestContract;
use Henrotaym\LaravelApiClient\Contracts\ClientContract;

/**
 * Page api.
 */
class PageApi implements PageApiContract
{
    /**
     * CLient communicating with chargebee api.
     * 
     * @var ClientContract
     */
    protected $client;

    /**
     * Constructor.
     * 
     * @param ClientContract
     */
    public function __construct(ClientContract $client)
    {
        $this->client = $client;
    }

    /**
     * Getting url allowing to pay invoices now.
     * 
     * @param PayNowRequestContract $request
     * @return string|null
     */
    public function payNow(PayNowRequestContract $request): ?string
    {
        $response = $this->client->try($request->get(), "Could not generate pay now page.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $response->response()->get()->hosted_page->url;
    }

    /**
     * Getting url managing payment methods.
     * 
     * @param PayNowRequestContract $request
     * @return string|null
     */
    public function managePaymentMethod(ManagePaymentMethodRequestContract $request): ?string
    {
        $response = $this->client->try($request->get(), "Could not generate page managing payment methods.");

        if ($response->failed()):
            report($response->error());
            return null;
        endif;

        return $response->response()->get()->hosted_page->url;
    }
}