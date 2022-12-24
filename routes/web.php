<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BahanMasukController;
use App\Http\Controllers\DataBahanController;
use App\Http\Controllers\BahanKeluarController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProdukJadiController;
use App\Http\Controllers\RegistrationController;
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

// kalo mau nambahin route baru, tinggal tambahin di grup ini, soalnya yang ini harus login dulu
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('dashboard', function () {
        return view('dashboard', ['tittle' => 'Dashboard', 'judul' => 'Dashboard', 'menu' => 'Dashboard', 'submenu' => 'Dashboard']);
    });
    // logout
    Route::post('logout', [RegistrationController::class, 'logout'])->name('logout');
    // mengarah ke setiap controller
    Route::resource('dataBahan', DataBahanController::class);
    Route::resource('bahanMasuk', BahanMasukController::class);
    Route::resource('bahanKeluar', BahanKeluarController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('produkJadi', ProdukJadiController::class);
    Route::resource('resep', ResepController::class);
    Route::resource('sopir', SopirController::class);
    Route::resource('mobil', MobilController::class);
});


// yang ini soalnya buat route yang bisa diakses tanpa login
Route::middleware('guest')->group(function () {
    // Register
    Route::get('register', [RegistrationController::class, 'index'])->name('register');
    Route::post('register', [RegistrationController::class, 'store'])->name('register');
    // Login
    Route::get('logout', [RegistrationController::class, 'login'])->name('login');
    Route::get('/', [RegistrationController::class, 'login'])->name('login');
    Route::get('login', [RegistrationController::class, 'login'])->name('login');
    Route::post('login', [RegistrationController::class, 'loginStore'])->name('login');

    // login dengan google
    Route::controller(GoogleController::class)->group(function () {
        Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
        Route::get('auth/google/callback', 'handleGoogleCallback');
    });
});
