<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostcardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\PayOrderController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return "hello";
//})->middleware(EnsureTokenIsValid::class);

//Route::middleware([EnsureTokenIsValid::class])->group(function () {
//    Route::get('/', function () {
//        return "hello";
//    });
//});

//Route::post('/t', function (Request $request) {
//    dd($request->boolean('bool'));
//    return "testing";
//});

Route::redirect('/', '/stores');

Route::resource('stores', StoreController::class);
Route::resource('regions', RegionController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('customers', CustomerController::class);

// For Learning
Route::resource('pay', PayOrderController::class);
Route::resource('postcards', PostcardController::class);
