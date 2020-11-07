<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\KategoriController;
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

Route::group(['middleware' => ['auth','verified','CheckRole:admin,ahli_tani,petani', 'CheckStatus:aktif']], function () {
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
        Route::group(['middleware' => ['auth', 'CheckRole:admin', 'CheckStatus:aktif']], function () {
            Route::prefix('user')->name('user.')->group(function () {
                Route::get('/all', [UserController::class, 'all'])->name('all');
                Route::put('/{user}/all', [UserController::class, 'allUpdate'])->name('all.update');
                Route::post('/add', [UserController::class, 'add'])->name('add');
                Route::put('/{user}/blokir', [UserController::class, 'blokir'])->name('blokir');
            });
        });
    });
});
