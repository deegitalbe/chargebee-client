<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Customer;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Customer\UpdateRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class UpdateRequest extends AbstractApiRequest implements UpdateRequestContract
{
    protected function build(RequestContract $request): RequestContract
    {
        return $request->setVerb('POST');
    }

  /**
     * Setting customer to work with.
     * 
     * @param string $customerId
     * @return static
     */
    public function setCustomer(string $customerId): UpdateRequestContract
    {
        $this->get()->setUrl($customerId);

        return $this;
    }

    /**
     * Setting related vat number.
     * 
     * @param string $locale
     * @return static
     */
    public function setLocale(string $locale): UpdateRequestContract
    {
        $this->get()->addQuery(['locale' => $locale]);

        return $this;
    }
}