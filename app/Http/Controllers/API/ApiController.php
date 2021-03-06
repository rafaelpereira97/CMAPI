<?php

namespace App\Http\Controllers\API;

use App\Entity;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Product;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('email',$request->email)->first();

            return response()->json(['id' => $user->id, 'name' => $user->name, 'email' => $user->email, '_token' => Hash::make(Str::random())],200);
        }

        return response()->json('login failed',403);
    }

    public function getRecommendedProducts(){
        $products = Product::with('entity','subcategory')->inRandomOrder()->limit(10)->get();
        return response()->json($this->mapProducts($products),200);
    }

    public function getProductsByNameAndSubcategory($searchString){
        $products = Product::with('subcategory','entity')->where('products.name','like','%'.$searchString.'%')->get();
        return response()->json($this->mapProducts($products),200);
    }

    public function getProducts(){
        $products = Product::with('entity','subcategory')->get();


        return response()->json($this->mapProducts($products),200);
    }

    public function getProductsByEntity($entity){
        $products = Product::with('entity','subcategory')
            ->where('entity_id',$entity)
            ->get();
        return response()->json($this->mapProducts($products),200);
    }

    public function getProductsBySubcategory($subcategory){
        $products = Product::with('entity','subcategory')
            ->where('subcategory_id',$subcategory)
            ->get();
        return response()->json($this->mapProducts($products),200);
    }


    public function getProductsByEntityAndSubcategory($entity,$subcategory){
        $products = Product::with('entity','subcategory')
            ->where('entity_id',$entity)
            ->where('subcategory_id',$subcategory)
            ->get();
        return response()->json($this->mapProducts($products),200);
    }

    public function getEntities(){
        $entities = Entity::all();
        $entities->map(function($entity){
            $entity['image'] = url('/').'/storage/'.$entity['image'];
        });
        return response()->json($entities);
    }

    public function getSubcategories(){
        $subcategories = Subcategory::all();
        return response()->json($subcategories);
    }



    public function mapProducts($products){
        $products->map(function ($product){
            $product['image'] = url('/').'/storage/'.$product['image'];
            $links = array();
            foreach (json_decode($product['images']) as $key => $image) {
                $links[] = (new \TCG\Voyager\Voyager)->image($image);
            }
            $product['images'] = json_encode($links);
        });

        return $products;
    }

}
