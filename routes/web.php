<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TemplateController;
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


Route::get('/',[TemplateController::class,'index'])->name('home');
Route::get('/about',[TemplateController::class,'about'])->name('about');
Route::get('/service',[TemplateController::class,'service'])->name('service');
Route::get('/produk',[TemplateController::class,'produk'])->name('produk');
Route::get('/produk/{category}',[TemplateController::class,'kategori'])->name('kategori');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart',[CartController::class,'index'])->name('cart.show');
    Route::post('cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/book',[JadwalController::class,'book'])->name('jadwal.book');
    Route::get('/jadwal',[JadwalController::class,'index'])->name('jadwal');
    Route::post('/jadwal',[JadwalController::class,'show'])->name('detail');
    Route::post('/jadwal/cancel',[JadwalController::class,'cancel'])->name('jadwal.cancel');
    Route::post('/jadwal/pinjam', [JadwalController::class, 'pinjam'])->name('pinjam');
    Route::patch('jadwal/serahkembali',[JadwalController::class,'serahkembali'])->name('jadwal.serahkembali');
    Route::post('/pembayaran',[PembayaranController::class,'show'])->name('pembayaran');
    Route::post('/bayar',[PembayaranController::class,'bayar'])->name('bayar');
    Route::patch('/bukti',[PembayaranController::class,'bukti'])->name('bukti');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/laporan', [AdminController::class, 'index'])->name('laporan');
    Route::get('/laporan/top',[AdminController::class, 'topBayar'])->name('laporan.top');
    Route::post('/jadwal/action', [AdminController::class, 'Action'])->name('jadwal.action');
    Route::post('/peminjaman', [AdminController::class, 'Peminjaman'])->name('peminjaman');
    Route::patch('/pengembalian', [AdminController::class, 'Pengembalian'])->name('pengembalian');
});


Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});