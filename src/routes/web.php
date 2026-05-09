<?php

use App\Http\Controllers\Articles\ArticleController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');

Route::get('/image', [ImageController::class, 'index'])->name('image.index');
Route::post('/image-upload', [ImageController::class, 'store'])->name('image.store');
