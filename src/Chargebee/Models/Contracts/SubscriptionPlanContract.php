<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;

/**
 * Representing a subscription plan.
 */
interface SubscriptionPlanContract extends HasAttributesContract
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
     * Setting subscription price in cent.
     * 
     * @param int $price
     * @return SubscriptionPlanContract
     */
    public function setPriceInCent(int $price): SubscriptionPlanContract;

    /**
     * Setting subscription price in euro.
     * 
     * @param int $price
     * @return SubscriptionPlanContract
     */
    public function setPriceInEuro(float $price): SubscriptionPlanContract;
    
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

    /**
     * Getting subscription price in cent.
     * 
     * @return int
     */
    public function getPriceInCent(): int;

    /**
     * Getting subscription price in euro.
     * 
     * @return float
     */
    public function getPriceInEuro(): float;
}