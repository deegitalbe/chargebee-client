<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

/**
 * Representing a subscription plan.
 */
class SubscriptionPlan implements SubscriptionPlanContract
{
    /**
     * Subscrption plan id.
     * @var string
     */
    protected $id;

    /**
     * Subscrption plan duration in days.
     * 
     * @var int
     */
    protected $trial_duration;
    
    /**
     * Setting customer id.
     * 
     * @param string
     * @return SubscriptionPlanContract
     */
    public function setId(string $id): SubscriptionPlanContract
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * Setting plan trial duration in days.
     * 
     * @param string
     * @return SubscriptionPlanContract
     */
    public function setTrialDuration(int $trial_duration): SubscriptionPlanContract
    {
        $this->trial_duration = $trial_duration;

        return $this;
    }
    
    /**
     * Getting plan id.
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    
    /**
     * Getting plan duration in days.
     * 
     * @return int
     */
    public function getTrialDuration(): int
    {
        return $this->trial_duration;
    }
}