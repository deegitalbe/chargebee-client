<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Subscriptions;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\PauseRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class PauseRequest extends AbstractApiRequest implements PauseRequestContract
{
    /**
     * Setting related subscription to pause.
     * 
     * @param string $subscriptionId
     */
    public function setSubscription(string $subscriptionId): PauseRequestContract
    {
        $this->get()->setUrl("subscriptions/$subscriptionId/pause");

        return $this;
    }

    /**
     * Pausing immediately.
     * 
     * @return static
     */
    public function immediately(): PauseRequestContract
    {
        $this->get()->addQuery(['pause_option' => "immediately"]);

        return $this;
    }

    /**
     * Telling if no action should be performed with unbilled charges.
     * 
     * @return static
     */
    public function keepUnbilledCharges(): PauseRequestContract
    {
        $this->get()->addQuery(['unbilled_charges_handling' => "no_action"]);

        return $this;
    }

    /**
     * Not knowing when subscription'll be resumed.
     * 
     * @param Carbon $resumeAt
     * @return static
     */
    public function resumeAt(Carbon $resumeAt): PauseRequestContract
    {
        $this->get()->addQuery(['resume_date' => $resumeAt->timestamp]);

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
        return $request->setVerb('POST');
    }
}