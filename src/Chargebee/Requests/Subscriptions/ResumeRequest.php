<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Requests\Subscriptions;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions\ResumeRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Requests\AbstractApiRequest;
use Henrotaym\LaravelApiClient\Contracts\RequestContract;

class ResumeRequest extends AbstractApiRequest implements ResumeRequestContract
{
    /**
     * Setting related subscription to pause.
     * 
     * @param string $subscriptionId
     */
    public function setSubscription(string $subscriptionId): ResumeRequestContract
    {
        $this->get()->setUrl("subscriptions/$subscriptionId/resume");

        return $this;
    }

    /**
     * Pausing immediately.
     * 
     * @return static
     */
    public function immediately(): ResumeRequestContract
    {
        $this->get()->addQuery(['resume_option' => "immediately"]);

        return $this;
    }

    /**
     * Telling if no action should be performed with unpaid invoices.
     * 
     * @return static
     */
    public function keepUnpaidInvoices(): ResumeRequestContract
    {
        $this->get()->addQuery(['unpaid_invoices_handling' => "no_action"]);

        return $this;
    }

    /**
     * Not knowing when subscription'll be resumed.
     * 
     * @param Carbon $resumeAt
     * @return static
     */
    public function resumeAt(Carbon $resumeAt): ResumeRequestContract
    {
        $this->get()->addQuery([
            'resume_option' => "specific_date",
            'resume_date' => $resumeAt->timestamp
        ]);

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