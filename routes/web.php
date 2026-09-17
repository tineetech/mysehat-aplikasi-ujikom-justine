<?php

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'indexHome'])->name('home');
Route::get('/produk', [LandingPageController::class, 'indexProduk'])->name('produk');
Route::get('/galery', [LandingPageController::class, 'indexGalery'])->name('galery');
