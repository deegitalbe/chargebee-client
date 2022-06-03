<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Subscriptions;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\ApiRequestContract;

interface PauseRequestContract extends ApiRequestContract
{
    /**
     * Setting related subscription to pause.
     * 
     * @param string $subscriptionId
     */
    public function setSubscription(string $subscriptionId): PauseRequestContract;

    /**
     * Pausing immediately.
     * 
     * @return static
     */
    public function immediately(): PauseRequestContract;

    /**
     * Telling if no action should be performed with unbilled charges.
     * 
     * @return static
     */
    public function keepUnbilledCharges(): PauseRequestContract;

   /**
     * Not knowing when subscription'll be resumed.
     * 
     * @param Carbon $resumeAt
     * @return static
     */
    public function resumeAt(Carbon $resumeAt): PauseRequestContract;
}