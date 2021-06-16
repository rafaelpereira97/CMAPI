<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getProducts(){
        $products = Product::with('entity','subcategory')->get();
        return response()->json($products,200);
    }

}
