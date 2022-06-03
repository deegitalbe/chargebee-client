<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface ResumeRequestContract extends ApiRequestContract
{
    /**
     * Setting related subscription to pause.
     * 
     * @param string $subscriptionId
     */
    public function setSubscription(string $subscriptionId): ResumeRequestContract;

    /**
     * Pausing immediately.
     * 
     * @return static
     */
    public function immediately(): ResumeRequestContract;

    /**
     * Telling if no action should be performed with unpaid invoices.
     * 
     * @return static
     */
    public function keepUnpaidInvoices(): ResumeRequestContract;

   /**
     * Not knowing when subscription'll be resumed.
     * 
     * @param Carbon $resumeAt
     * @return static
     */
    public function resumeAt(Carbon $resumeAt): ResumeRequestContract;
}