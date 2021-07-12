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
Route::middleware('api')->prefix('api')->group(function () {
    
});
Route::middleware('api')->name('api.')->group(
    function(){
        Route::get('loginCheck', [App\Http\Controllers\Api\UserManageController::class, 'loginCheck'])->name('user.LoginCheck');
        Route::get('products', [App\Http\Controllers\Api\ProductManageController::class, 'products'])->name('product.ProductsManage');
        Route::get('productDetail', [App\Http\Controllers\Api\ProductManageController::class, 'detail'])->name('product.ProductDetailManage');        
        Route::get('productItems', [App\Http\Controllers\Api\ProductManageController::class, 'items'])->name('product.ProductItemsManage');
        Route::get('productOptions', [App\Http\Controllers\Api\ProductManageController::class, 'options'])->name('product.ProductOptionsManage');
        Route::get('marketAccounts', [App\Http\Controllers\Api\ProductManageController::class, 'marketAccounts'])->name('product.ProductOptionsManage');
        // Route::get('posts/{id}', ['uses'=>'PostsAPIController@show']);

});
