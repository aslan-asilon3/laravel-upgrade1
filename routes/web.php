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
        
        // =====Data produk
        Route::get('/produk', [App\Http\Controllers\ProductController::class, 'index'])->name('produk');
        // Route::get('/produk', [App\Http\Controllers\ProductController::class, 'ajax'])->name('ajax-produk');
        // Route::post('/produk-import', [ProductController::class, 'import'])->name('produk-import');
        // Route::post('/produk-export', [ProductController::class, 'export'])->name('produk-export');
        // Route::get('/produk/download-template', [ProductController::class, 'DownloadTemplate'])->name('produk-download-template');
        // =====End Data produk
    });

});



Route::get('user-page', function() {
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    return 'Halaman untuk User';
})->middleware('role:user')->name('user.page');

