<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Tempat_LayananController;
use App\Http\Controllers\UserController;
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

Route::get('/', [WebController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Kecamatan
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/add', [KecamatanController::class, 'add']);
Route::post('/kecamatan/insert', [KecamatanController::class, 'insert']);
Route::get('/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

//Kategori Layanan
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/add', [KategoriController::class, 'add']);
Route::post('/kategori/insert', [KategoriController::class, 'insert']);
Route::get('/kategori/edit/{id_kategori}', [KategoriController::class, 'edit']);
Route::post('/kategori/update/{id_kategori}', [KategoriController::class, 'update']);
Route::get('/kategori/delete/{id_kategori}', [KategoriController::class, 'delete']);

//Tempat Layanan
Route::get('/tempat_layanan', [Tempat_LayananController::class, 'index'])->name('tempat_layanan');
Route::get('/tempat_layanan/add', [Tempat_LayananController::class, 'add']);
Route::post('/tempat_layanan/insert', [Tempat_LayananController::class, 'insert']);
Route::get('/tempat_layanan/edit/{id_tempat}', [Tempat_LayananController::class, 'edit']);
Route::post('/tempat_layanan/update/{id_tempat}', [Tempat_LayananController::class, 'update']);
Route::get('/tempat_layanan/delete/{id_tempat}', [Tempat_LayananController::class, 'delete']);

//user
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::post('/user/update/{id}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);

//frontend
Route::get('/kecamatan/{id_kecamatan}', [WebController::class, 'kecamatan']);
Route::get('/kategori/{id_kategori}', [WebController::class, 'kategori']);
Route::get('/detailtempatlayanan/{id_tempat}', [WebController::class, 'detailtempatlayanan']);