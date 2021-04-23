<?php

use App\Http\Controllers\ProductApiController;
use App\Models\Product;
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

Route::get('/products', [ProductApiController::class, 'index']);

Route::post('/products', [ProductApiController::class, 'create']);

Route::put(`/products/{id}`, function(Product $product) {
    request()->validate([
        'name' => 'required',
        'category' => 'required',
        'rating' => ['required', 'max:5.0', 'min:0.0'],
        'price' => ['required', 'min:0.0'],
        'inventory' => 'required'
    ]);

    $success = $product->update(request()->all());

    return [
        'success' => $success
    ];
});

Route::delete(`/products/{product}`, function(Product $product) {
    $success = $product->delete();

    return [
        'success' => $success
    ];
});
