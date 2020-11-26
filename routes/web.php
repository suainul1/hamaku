<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\HamaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriGejalaController;
use App\Http\Controllers\PakarController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::view('/', 'home.index')->name('home');
});

Route::group(['middleware' => ['auth', 'verified', 'CheckRole:admin,ahli_tani,petani', 'CheckStatus:aktif']], function () {
    Route::prefix('room')->name('room.')->group(function () {
        Route::get('/', [RoomController::class, 'index'])->name('index');
        Route::post('/konsul/{ahli}', [RoomController::class, 'konsul'])->name('konsul');
        Route::post('/chat/{to}', [RoomController::class, 'chat'])->name('chat');
    });
    Route::prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/', [ArtikelController::class, 'index'])->name('index');
        Route::get('/show/{artikel}', [ArtikelController::class, 'show'])->name('show');
    });
    Route::prefix('user')->name('user.')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
    });

    Route::group(['middleware' => ['auth', 'CheckRole:admin,ahli_tani', 'CheckStatus:aktif']], function () {
        Route::prefix('artikel')->name('artikel.')->group(function () {

            Route::get('/create', [ArtikelController::class, 'create'])->name('create');
            Route::post('/create', [ArtikelController::class, 'store']);
            Route::get('/edit/{artikel}', [ArtikelController::class, 'edit'])->name('edit');
            Route::post('/edit/{artikel}', [ArtikelController::class, 'update']);
            Route::get('/{artikel}', [ArtikelController::class, 'destroy'])->name('delete');
        });

        Route::prefix('kategori')->name('kategori.')->group(function () {
            Route::get('/', [KategoriController::class, 'index'])->name('index');
            Route::post('/', [KategoriController::class, 'create']);
            Route::put('/{kategori}', [KategoriController::class, 'update'])->name('update');
            Route::delete('/{kategori}', [KategoriController::class, 'destroy'])->name('delete');
        });
    });
    Route::group(['middleware' => ['auth', 'CheckRole:petani', 'CheckStatus:aktif']], function () {
        Route::prefix('pakar')->name('pakar.')->group(function () {
            Route::get('/diagnosa/{step?}', [PakarController::class, 'index'])->name('index');
        });
    });
    Route::group(['middleware' => ['auth', 'CheckRole:admin', 'CheckStatus:aktif']], function () {
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/all', [UserController::class, 'all'])->name('all');
            Route::put('/{user}/all', [UserController::class, 'allUpdate'])->name('all.update');
            Route::post('/add', [UserController::class, 'add'])->name('add');
            Route::put('/{user}/blokir', [UserController::class, 'blokir'])->name('blokir');
        });
        Route::prefix('pakar')->name('pakar.')->group(function () {
            Route::get('/', [PakarController::class, 'setting'])->name('setting');
            Route::post('/setting/gejala', [PakarController::class, 'createGejala'])->name('createGejala');
        });
        Route::prefix('kategori-gejala')->name('kategoriGejala.')->group(function () {
            Route::post('/create', [KategoriGejalaController::class, 'create'])->name('create');
            Route::put('/edit/{kategori}', [KategoriGejalaController::class, 'edit'])->name('edit');
            Route::delete('/delete/{kategori}', [KategoriGejalaController::class, 'delete'])->name('delete');
        });
        Route::prefix('hama')->name('hama.')->group(function () {
            Route::post('/create', [HamaController::class, 'create'])->name('create');
            Route::put('/edit/{hama}', [HamaController::class, 'edit'])->name('edit');
            Route::delete('/delete/{hama}', [HamaController::class, 'delete'])->name('delete');
        });
        Route::prefix('gejala')->name('gejala.')->group(function () {
            Route::post('/create', [GejalaController::class, 'create'])->name('create');
            Route::put('/edit/{gejala}', [GejalaController::class, 'edit'])->name('edit');
            Route::delete('/delete/{gejala}', [GejalaController::class, 'delete'])->name('delete');
        });
    });
});
