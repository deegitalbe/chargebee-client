<?php
namespace Deegitalbe\ChargebeeClient\Chargebee\Models;

use Carbon\Carbon;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\CustomerApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\CustomerContract;
use stdClass;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Traits\HasAttributes;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;

/**
 * Representing an invoice
 */
class Invoice implements InvoiceContract
{
    use HasAttributes;

    /**
     * Getting late statuses.
     * 
     * @return array
     */
    public static function lateStatuses(): array
    {
        return [
            'not_paid',
            'payment_due'
        ];
    }

    /**
     * Cosntruction invoice instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->attributes = json_decode(json_encode([
            'invoice' => new stdClass
        ]));
    }

    /**
     * Getting id.
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->getRawInvoice()->id;
    }

    /**
     * Getting related customer id.
     * 
     * @param string
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->getRawInvoice()->customer_id;
    }

    /**
     * Getting related subscription id.
     * 
     * @return ?string
     */
    public function getSubscriptionId(): ?string
    {
        return $this->getRawInvoice()->subscription_id ?? null;
    }

    /**
     * Getting due date.
     * 
     * @return Carbon
     */
    public function getDueDate(): Carbon
    {
        return new Carbon($this->getRawInvoice()->due_date);
    }

    /**
     * Getting creation date.
     * 
     * @return string
     */
    public function getCreatedAt(): Carbon
    {
        return new Carbon($this->getRawInvoice()->due_date);
    }

    /**
     * Getting related customer
     * 
     * @return CustomerContract|null
     */
    public function getCustomer(): ?CustomerContract
    {
        /** @var CustomerApiContract */
        $customerApi = app()->make(CustomerApiContract::class);

        return $customerApi->find($this->getCustomerId());
    }

    /**
     * Getting status
     * 
     * @return string
     */
    public function getStatus(): string
    {
        return $this->getRawInvoice()->status;
    }

    /**
     * Getting invoice ammount.
     * 
     * @return int
     */
    public function getTotal(): int
    {
        return $this->getRawInvoice()->total;
    }

    /**
     * Getting underlying raw invoice.
     * 
     * @return stdClass
     */
    protected function getRawInvoice(): stdClass
    {
        return $this->attributes->invoice;
    }

    public function isFullyPaid(): bool
    {
        return $this->getAmountDue() === 0;
    }

    public function stillRequiresPayment(): bool
    {
        return !$this->isFullyPaid();
    }

    public function getAmountDue(): int
    {
        return $this->getRawInvoice()->amount_due;
    }

    public function getAmountPaid(): int
    {
        return $this->getRawInvoice()->amount_paid;
    }
}