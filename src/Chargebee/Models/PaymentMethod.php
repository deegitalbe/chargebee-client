<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Deegitalbe\ChargebeeClient\Chargebee\Enums\PaymentMethodStatus;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\PaymentMethodContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;

/**
 * Representing a chargebee customer payment method
 */
class PaymentMethod implements PaymentMethodContract
{
    protected PaymentMethodStatus $status;

    use HasAttributes { setAttributes as setDefaultAttributes; }

    public function setAttributes($attributes)
    {
        $this->setDefaultAttributes($attributes);
        $this->status = PaymentMethodStatus::from($this->attributes->status);

        return $this;
    }

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
        return $this->getStatus() === PaymentMethodStatus::VALID;
    }

    /**
     * Telling if payment method is about to expire.
     * 
     * @return bool
     */
    public function isExpiring(): bool
    {
        return $this->getStatus() === PaymentMethodStatus::EXPIRING;

    }

    /**
     * Telling if payment method is pending verification.
     * 
     * @return bool
     */
    public function isPendingVerification(): bool
    {
        return $this->getStatus() === PaymentMethodStatus::PENDING_VERIFICATION;
    }

    /**
     * Getting status.
     * 
     * @return PaymentMethodStatus
     */
    public function getStatus(): PaymentMethodStatus
    {
        return $this->status;
    }
}