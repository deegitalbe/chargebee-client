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
    public function getCustomerId(): string;

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
     * Getting late statuses.
     * 
     * @return array
     */
    public static function lateStatuses(): array;
}