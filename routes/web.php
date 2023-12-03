<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function() {
    return view('index');
});

//melakukan checkout (ambil link paymentnya)
Route::post('lanjut', [CheckoutController::class, 'bayar'])->name('post.post');

//cek apakah sudah bayar
//mengambil token/ID-trx dari paypal di /return
Route::get('return', [CheckoutController::class, 'cekpayment'])->name('return');

//cek detail pembayaran akan muncul data orang yang melakukan payment
Route::get('detail/{orderId}', [CheckoutController::class, 'detail']);

