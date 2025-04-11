<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DusunController;
use App\Http\Controllers\KomoditiController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\UserController;

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
Route::middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // profile
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/settings/{username}', [UserController::class, 'update'])->name('profileUpdate');

    // dusun
    Route::get('/dusun', [DusunController::class, 'index'])->name('dusun');
    Route::post('/dusun-save', [DusunController::class, 'store'])->name('simpanDusun');
    Route::put('/dusun-update', [DusunController::class, 'update'])->name('updateDusun');
    Route::get('/dusun-destroy/{idDusun}', [DusunController::class, 'destroy'])->name('hapusDusun');

    // komoditas
    Route::get('/komoditas', [KomoditiController::class, 'index'])->name('komoditas');
    Route::post('/komoditas-save', [KomoditiController::class, 'store'])->name('simpanKomoditas');
    Route::put('/komoditas-update', [KomoditiController::class, 'update'])->name('updateKomoditas');
    Route::get('/komoditas-destroy/{idKomoditas}', [KomoditiController::class, 'destroy'])->name('hapusKomoditas');

    // lahan
    Route::get('/lahan', [LahanController::class, 'index'])->name('lahan');
    Route::post('/lahan-save', [LahanController::class, 'store'])->name('simpanLahan');
    Route::put('/lahan-update', [LahanController::class, 'update'])->name('updateLahan');
    Route::get('/lahan-destroy/{idLahan}', [LahanController::class, 'destroy'])->name('hapusLahan');
});

