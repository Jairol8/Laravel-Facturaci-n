<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        return view('admin.products.index',compact('products','categories'));
    }

    public function store(Request $request)
    {
        Product::create($request->validate([
            'name'=>'required',
            'price'=>'required|numeric',
            'grams'=>'required|integer',
            'category_id'=>'required'
        ]));

        return back();
    }
}

