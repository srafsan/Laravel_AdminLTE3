<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StoreController;
use App\Models\Store;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/store-lists', function () {
    $lists = Store::all();
    return view('store.allStore', ['data' => $lists]);
});
Route::get('/add-store' , function () {
    return view('store.addStore');
});
Route::get('/update-store/{id}', function($id) {
    $list = Store::findOrFail($id);
    return view('store.updateStore', ['store' => $list]);
})->name('updateStore');

Route::group(['prefix' => 'api/v1'], function() {
    Route::resource('stores', StoreController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
});
