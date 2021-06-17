<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[\App\Http\Controllers\API\ApiController::class, 'login'])->name('login');
Route::get('getRecommendedProducts',[\App\Http\Controllers\API\ApiController::class,'getRecommendedProducts'])->name('getRecommendedProducts');
Route::get('getProductsByNameAndSubcategory/{searchString}',[\App\Http\Controllers\API\ApiController::class,'getProductsByNameAndSubcategory'])->name('getProductsByNameAndSubcategory');


Route::get('getProducts',[\App\Http\Controllers\API\ApiController::class,'getProducts'])->name('getProducts');
Route::get('getEntities',[\App\Http\Controllers\API\ApiController::class,'getEntities'])->name('getEntities');
Route::get('getProductsByEntity/{entity}',[\App\Http\Controllers\API\ApiController::class,'getProductsByEntity'])->name('getProductsByEntity');
Route::get('getProductsByEntityAndSubcategory/{entity}/{subcategory}',[\App\Http\Controllers\API\ApiController::class,'getProductsByEntityAndSubcategory'])->name('getProductsByEntityAndSubcategory');
Route::get('getSubcategories',[\App\Http\Controllers\API\ApiController::class,'getSubcategories'])->name('getSubcategories');
Route::get('getProductsBySubcategory/{subcategory}',[\App\Http\Controllers\API\ApiController::class,'getProductsBySubcategory'])->name('getProductsBySubcategory');
