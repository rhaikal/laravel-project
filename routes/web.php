<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\DashboardPesanController;

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

Route::get('/pesan/checkout', [PesanController::class, 'checkOut'])->name('checkout');

Route::delete('/pesan/checkout/{pesananDetail:id}', [PesanController::class, 'destroy']);

Route::get('/pesan/konfirmasi', [PesanController::class, 'confirm']);

Route::get('/pesan/{barang:id}', [PesanController::class, 'show']);

Route::post('/pesan/{barang:id}', [PesanController::class, 'order']);

Route::get('/profile', [UserController::class, 'index']);

Route::get('/history', [HistoryController::class, 'index']);
Route::get('/history/{pesanan:code}', [HistoryController::class, 'show']);

Route::get('/settings', [UserController::class, 'edit']);
Route::post('/settings', [UserController::class, 'update']);

Route::resource('dashboard/barangs', BarangController::class)->middleware('admin');
Route::resource('dashboard/pesanans', DashboardPesanController::class)->middleware('admin')->except(['create', 'store','edit'])->scoped([
    'pesanan' => 'code',
]);