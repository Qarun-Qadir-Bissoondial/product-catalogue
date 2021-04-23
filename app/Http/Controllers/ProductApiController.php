<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    //

    public function index() {
        return Product::all();
    }

    public function create(Request $request) {


        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'rating' => ['required', 'max:5.0', 'min:0.0'],
            'price' => ['required', 'min:0.0'],
            'inventory' => 'required'
        ]);

        return Product::create($request->all());
    }
}
