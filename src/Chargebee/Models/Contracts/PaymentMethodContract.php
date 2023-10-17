<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Enums\PaymentMethodStatus;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;

/**
 * Representing a chargebee customer payment method
 */
interface PaymentMethodContract extends HasAttributesContract
{
    /**
     * Telling if payment method is sepa.
     * 
     * @return bool
     */
    public function isSepa(): bool;

    /**
     * Telling if payment method is card.
     * 
     * @return bool
     */
    public function isCard(): bool;

    /**
     * Telling if payment method is valid.
     * 
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Telling if payment method is about to expire.
     * 
     * @return bool
     */
    public function isExpiring(): bool;

    /**
     * Telling if payment method is pending verification.
     * 
     * @return bool
     */
    public function isPendingVerification(): bool;

    /**
     * Getting status.
     * 
     * @return PaymentMethodStatus
     */
    public function getStatus(): PaymentMethodStatus;
}