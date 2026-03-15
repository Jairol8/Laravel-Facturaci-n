<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Client;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;


class SaleController extends Controller
{
    // Mostrar lista de ventas
    public function index()
{
    $sales = Sale::with('client')
                ->orderBy('id','desc')
                ->get();

    $clients  = Client::all();
    $products = Product::all();

    return view('sales.index', compact('sales','clients','products'));
}


    // Formulario para nueva venta
    public function create()
    {
        $clients  = Client::all();
        $products = Product::all();

        return view('sales.create', compact('clients','products'));
    }

    // Guardar venta
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'products'  => 'required|array'
        ]);

        $subtotal = 0;

        // Calcular total
        foreach($request->products as $p){

            if($p['quantity'] > 0){

                $subtotal += $p['price'] * $p['quantity'];
            }
        }

        // Validar que tenga productos
        if($subtotal <= 0){
            return back()->with('error','Debes agregar al menos un producto');
        }

        // Crear venta
        $sale = Sale::create([

            'folio'     => 'F-'.time(),
            'client_id' => $request->client_id,
            'subtotal'  => $subtotal,
            'total'     => $subtotal

        ]);

        // Guardar detalles
        foreach($request->products as $p){

            if($p['quantity'] > 0){

                SaleDetail::create([

                    'sale_id'   => $sale->id,
                    'product_id'=> $p['id'],
                    'quantity'  => $p['quantity'],
                    'price'     => $p['price'],
                    'subtotal'  => $p['price'] * $p['quantity']

                ]);
            }
        }

        return redirect()
                ->route('sales.show',$sale->id)
                ->with('success','Venta registrada correctamente');
    }

    // Mostrar una venta
    public function show($id)
    {
        $sale = Sale::with(['client','details.product'])
                    ->findOrFail($id);

        return view('sales.show', compact('sale'));
    }

    // Eliminar venta
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        // Borrar detalles primero
        $sale->details()->delete();

        $sale->delete();

        return redirect()
                ->route('sales.index')
                ->with('success','Venta eliminada');
    }
     public function pdf($id)

    {
    $sale = Sale::with(['client','details.product'])
                ->findOrFail($id);

    $pdf = Pdf::loadView('sales.pdf', compact('sale'));

    return $pdf->download('factura_'.$sale->folio.'.pdf');

    }


}
