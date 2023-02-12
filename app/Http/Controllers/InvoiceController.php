<?php
namespace App\Http\Controllers;
use App\Models\Invoice;

use LaravelDaily\Invoices\Invoice as InvoiceDocument;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
/** 
* Usamos model binding 
* 
* @param Invoice $invoice
* @return \Illuminate\Http\Response
*/
public function export(Invoice $invoice){
    $invoice->load([
        'customer' => function ($query) {
            $query->select(['id', 'business_name', 'code', 'address', 'phone']); 
        },
        'products' => function ($query) {
             $query->select(['id', 'description', 'price', 'unit'])
                 ->withPivot(['quantity', 'discount']);
        },
    ]);

    $seller = new Party([
        'name' => 'Mi Empresa',
        'code' => '123 318 9486',
        'custom_fields' => [
            'address' => 'Colombia',
            'phone' => '123 123 2233',
        ],
    ]);

    $customer = new Party([
        'name' => $invoice->customer->business_name,
        'code' => $invoice->customer->code,
        'address' => $invoice->customer->address,
        'phone' => $invoice->customer->phone,
    ]);

    $items = collect();

    $invoice->products->each(function ($product) use (&$items) {
        $item = new InvoiceItem();
        $item->title($product->description)
            ->pricePerUnit($product->price)
            ->quantity($product->pivot->quantity)
            ->discount($product->pivot->quantity) // Opcional: ->discountByPercent(9)
            ->units($product->unit);

        $items->push($item);
    });

    $notes = [
        'Nota No. 1 de la factura',
        'Nota No. 2 de la factura',
    ];

    $notes = implode("<br>", $notes);

    $invoiceDocument = InvoiceDocument::make('receipt')
        ->series($invoice->prefix)
        ->sequence($invoice->number)
        ->serialNumberFormat('{SERIES}-{SEQUENCE}')
        ->seller($seller)
        ->buyer($customer)
        ->date($invoice->created_at)
        ->dateFormat('m/d/Y')
        ->payUntilDays($invoice->due_days)
        ->currencySymbol('$') ->currencyCode('USD')
        ->currencyFormat('{SYMBOL} {VALUE}')
        ->currencyThousandsSeparator('.')
        ->currencyDecimalPoint(',')
        ->filename($invoice->number)
        ->addItems($items->toArray())
        ->notes($notes)
        ->logo(public_path('vendor/invoices/sample-logo.png'))
        ->template('invoice'); // Plantilla personalizada

    return $invoiceDocument->stream();
}
}