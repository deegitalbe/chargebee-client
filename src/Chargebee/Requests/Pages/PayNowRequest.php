<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Pages;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Pages\PayNowRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class PayNowRequest extends AbstractApiRequest implements PayNowRequestContract
{
    /**
     * Setting related customer.
     * 
     * @param string $customerId
     * @return static
     */
    public function customer(string $customerId): PayNowRequestContract
    {
        $this->get()->addQuery(['customer[id]' => $customerId]);

        return $this;
    }

    /**
     * Setting redirect url after success.
     * 
     * @param string $successUrl
     * @return static
     */
    public function redirectTo(string $successUrl): PayNowRequestContract
    {
        $this->get()->addQuery(['redirect_url' => $successUrl]);

        return $this;
    }

    /**
     * Building a fresh request.
     * 
     * @param RequestContract $request
     * @return RequestContract
     */
    protected function build(RequestContract $request): RequestContract
    {
        return $request->setUrl('collect_now')
            ->setVerb('POST');
    }
}