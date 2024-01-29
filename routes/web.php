<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::redirect('/','/login'); 

Route::get('/log', function () {
    return view('login');
});
Route::get('/reg', function () {
    return view('register');
});
Route::get('/recovery-password', function () {
    return view('recovery_password');
});

Route::get('/pemasukan', function () {
    return view('pemasukan');
});
Route::get('/pengeluaran', function () {
    return view('pengeluaran');
});

Route::group(['middleware' => ['checklogin']], function() {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi-store');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->name('transaksi-update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi-delete');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
