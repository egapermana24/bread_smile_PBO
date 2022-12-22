<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\DataBahanController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProdukJadiController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\SopirController;

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

// mengarah ke setiap controller
Route::resource('dataBahan', DataBahanController::class);
Route::resource('bahanMasuk', BahanMasukController::class);
Route::resource('bahanKeluar', BahanKeluarController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('produkJadi', ProdukJadiController::class);
Route::resource('resep', ResepController::class);
Route::resource('sopir', SopirController::class);
Route::resource('mobil', MobilController::class);
