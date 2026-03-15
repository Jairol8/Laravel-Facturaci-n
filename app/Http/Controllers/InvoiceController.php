<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $sale = Sale::with('details.product','client')->findOrFail($id);

        $pdf = Pdf::loadView('invoices.pdf', compact('sale'));

        return $pdf->stream("factura_{$sale->folio}.pdf");
    }
}
