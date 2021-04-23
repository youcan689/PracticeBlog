<?php

namespace App\Http\Controllers;

use App\Product;

class ConsumerController extends Controller
{
    public function showProducts()
    {
        return view('consumer.products');
    }

    public function getProducts()
    {
        return Product::where('published','=',1)->get();
    }
}
