<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Contracts;

use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\SubscriptionContract;
use Illuminate\Support\Collection;

/**
 * Subscription invoices repository.
 */
interface SubscriptionInvoiceApiContract
{
    /**
     * Setting related subscription.
     * 
     * @param SubscriptionContract $subscription
     * @return static
     */
    public function setSubscription(SubscriptionContract $subscription): SubscriptionInvoiceApiContract;

    /**
     * Getting late invoices.
     * 
     * @return int|null Null if not found.
     */
    public function lateCount(): ?int;

    /**
     * Getting late invoices.
     * 
     * @return Collection|null Null if error.
     */
    public function late(): ?Collection;

    /**
     * Getting last late invoice related.
     * 
     * @return InvoiceContract|null
     */
    public function firstLate(): ?InvoiceContract; 
}