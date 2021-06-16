<?php

namespace App\Http\Controllers\API;

use App\Entity;
use App\Http\Controllers\Controller;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getProducts(){
        $products = Product::with('entity','subcategory')->get();
        return response()->json($products,200);
    }

    public function getProductsByEntity($entity){
        $products = Product::with('entity','subcategory')
            ->where('entity_id',$entity)
            ->get();
        return response()->json($products,200);
    }

    public function getProductsBySubcategory($subcategory){
        $products = Product::with('entity','subcategory')
            ->where('subcategory_id',$subcategory)
            ->get();
        return response()->json($products,200);
    }

    public function getProductsByEntityAndSubcategory($entity,$subcategory){
        $products = Product::with('entity','subcategory')
            ->where('entity_id',$entity)
            ->where('subcategory_id',$subcategory)
            ->get();
        return response()->json($products,200);
    }

    public function getEntities(){
        $entities = Entity::all();
        return response()->json($entities);
    }

    public function getSubcategories(){
        $subcategories = Subcategory::all();
        return response()->json($subcategories);
    }

}
