<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'nullable'
        ]);

        Client::create($request->only('name','phone'));

        return back();
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        return back();
    }
}
