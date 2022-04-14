<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts;

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
     * Getting late statuses.
     * 
     * @return array
     */
    public static function lateStatuses(): array;
}