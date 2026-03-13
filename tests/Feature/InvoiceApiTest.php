<?php
namespace Deegitalbe\ChargebeeClient\Tests\Feature;

use Deegitalbe\ChargebeeClient\Chargebee\Contracts\InvoiceApiContract;
use Deegitalbe\ChargebeeClient\Chargebee\Contracts\Requests\Invoices\InvoiceListRequestContract;
use Deegitalbe\ChargebeeClient\Chargebee\Models\Contracts\InvoiceContract;
use Deegitalbe\ChargebeeClient\Tests\TestCase;
use Illuminate\Support\Collection;

class InvoiceApiTest extends TestCase
{
    /** @test */
    public function it_can_list_invoices()
    {
        /** @var InvoiceApiContract */
        $invoiceApi = app()->make(InvoiceApiContract::class);

        /** @var InvoiceListRequestContract */
        $request = app()->make(InvoiceListRequestContract::class);
        $request->customer('AzyjngVDkQvEQ5TmD')
            ->latest()
            ->limit(5);

        $invoices = $invoiceApi->index($request);

        $this->assertInstanceOf(Collection::class, $invoices);
    }

    /** @test */
    public function it_can_get_first_invoice()
    {
        /** @var InvoiceApiContract */
        $invoiceApi = app()->make(InvoiceApiContract::class);

        /** @var InvoiceListRequestContract */
        $request = app()->make(InvoiceListRequestContract::class);
        $request->customer('AzyjngVDkQvEQ5TmD')
            ->latest();

        $invoice = $invoiceApi->first($request);

        if ($invoice) {
            $this->assertInstanceOf(InvoiceContract::class, $invoice);
        } else {
            $this->assertNull($invoice);
        }
    }
}
