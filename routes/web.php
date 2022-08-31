<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Produk\Index;
use App\Models\Product;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'role:admin'], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');
        
        // =====Data product
        Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
        Route::post('/product-export', [App\Http\Controllers\ProductController::class, 'export'])->name('product-export');
        // Route::get('/product', [App\Http\Controllers\ProductController::class, 'ajax'])->name('ajax-produk');
        // Route::post('/product-import', [ProductController::class, 'import'])->name('produk-import');
        // Route::get('/product/download-template', [ProductController::class, 'DownloadTemplate'])->name('produk-download-template');
        // =====End Data produk
    });

});



Route::get('user-page', function() {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    return 'Halaman untuk User';
})->middleware('role:user')->name('user.page');

