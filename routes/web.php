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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
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


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi-store');
