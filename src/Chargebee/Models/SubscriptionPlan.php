<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use stdClass;
use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionPlanContract;

/**
 * Representing a subscription plan.
 */
class SubscriptionPlan implements SubscriptionPlanContract
{
    use HasAttributes;

    /**
     * Cosntruction subscription plan instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->attributes = json_decode(json_encode([
            'plan' => new stdClass
        ]));
    }
    
    /**
     * Setting customer id.
     * 
     * @param string
     * @return SubscriptionPlanContract
     */
    public function setId(string $id): SubscriptionPlanContract
    {
        $this->getRawPlan()->id = $id;

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
        $this->getRawPlan()->trial_period = $trial_duration;

        return $this;
    }
    
    /**
     * Setting subscription_plan price in cent.
     * 
     * @param int $price
     * @return SubscriptionPlanContract
     */
    public function setPriceInCent(int $price): SubscriptionPlanContract
    {
        $this->getRawPlan()->price = $price;
        
        return $this;
    }

    /**
     * Setting subscription_plan price in euro.
     * 
     * @param int $price
     * @return SubscriptionPlanContract
     */
    public function setPriceInEuro(float $price): SubscriptionPlanContract
    {
        return $this->setPriceInCent(bcmul($price, 100));
    }
    
    /**
     * Getting plan id.
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->getRawPlan()->id;
    }
    
    /**
     * Getting plan duration in days.
     * 
     * @return int
     */
    public function getTrialDuration(): int
    {
        return $this->getRawPlan()->trial_period;
    }

    /**
     * Getting subscription plan price in cent.
     * 
     * @return int
     */
    public function getPriceInCent(): int
    {
        return $this->getRawPlan()->price;
    }

    /**
     * Getting subscription plan price in euro.
     * 
     * @return float
     */
    public function getPriceInEuro(): float
    {
        return bcdiv($this->getPriceInCent(), 100);
    }

    /**
     * Getting underlying plan.
     * 
     * @return stdClass
     */
    public function getRawPlan(): stdClass
    {
        return $this->attributes->plan;
    }

}