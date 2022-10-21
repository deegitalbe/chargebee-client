<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\HasAttributesContract;

/**
 * Representing an invoice.
 */
interface InvoiceContract extends HasAttributesContract
{
    /**
     * Getting related customer id.
     * 
     * @return string
     */
    public function getId(): string;

    /**
     * Getting related customer id.
     * 
     * @return string
     */
    public function getCustomerId(): string;

    /**
     * Getting related subscription id.
     * 
     * @return ?string
     */
    public function getSubscriptionId(): ?string;

    /**
     * Getting due date.
     * 
     * @return Carbon
     */
    public function getDueDate(): Carbon;

    /**
     * Getting creation date.
     * 
     * @return string
     */
    public function getCreatedAt(): Carbon;

    /**
     * Getting status
     * 
     * @return string
     */
    public function getStatus(): string;

    /**
     * Getting invoice ammount.
     * 
     * @return int
     */
    public function getTotal(): int;

    /**
     * Getting late statuses.
     * 
     * @return array
     */
    public static function lateStatuses(): array;
}