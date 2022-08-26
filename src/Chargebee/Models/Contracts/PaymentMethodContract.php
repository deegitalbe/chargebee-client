<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

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
}