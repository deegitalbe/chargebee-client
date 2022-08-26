<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;

/**
 * Representing a chargebee customer payment method
 */
class PaymentMethod implements PaymentMethodContract
{
    use HasAttributes;

    /**
     * Telling if payment method is sepa.
     * 
     * @return bool
     */
    public function isSepa(): bool
    {
        return $this->attributes->type === 'direct_debit';
    }

    /**
     * Telling if payment method is card.
     * 
     * @return bool
     */
    public function isCard(): bool
    {
        return $this->attributes->type === 'card';
    }

    /**
     * Telling if payment method is valid.
     * 
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->attributes->status === 'valid';
    }
}