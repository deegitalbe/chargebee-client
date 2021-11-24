<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

/**
 * Representing a subscription plan.
 */
interface SubscriptionPlanContract
{
    /**
     * Setting customer id.
     * 
     * @param string
     * @return SubscriptionPlanContract
     */
    public function setId(string $id): SubscriptionPlanContract;
    
    /**
     * Setting plan trial duration in days.
     * 
     * @param string
     * @return SubscriptionPlanContract
     */
    public function setTrialDuration(int $trial_duration): SubscriptionPlanContract;
    
    /**
     * Getting plan id.
     * 
     * @return string
     */
    public function getId(): string;
    
    /**
     * Getting plan duration in days.
     * 
     * @return int
     */
    public function getTrialDuration(): int;
}