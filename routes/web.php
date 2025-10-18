<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


Route::get('/', [MovieController::class, 'index']);
Route::post('/movies/like', [MovieController::class, 'likeMovie'])->name('movies.like');
Route::get('/movies/recommendations', [MovieController::class, 'recommendations'])->name('movies.recommendations');
