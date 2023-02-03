<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;

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

Route::get('/movie', [MovieController::class, 'index'])->name('movie');
Route::get('movie/create', [MovieController::class, 'create'])->name('movie.create');
Route::post('movie/store', [MovieController::class, 'store'])->name('movie.store');
Route::get('movie/{id}/edit', [MovieController::class, 'edit'])->name('movie.edit');
Route::post('movie/update', [MovieController::class, 'update'])->name('movie.update');
Route::get('movie/{movie}/delete', [MovieController::class, 'destroy'])->name('movie.destroy');
Route::get('movie/{movie}/toggle', [MovieController::class, 'toggleStatus'])->name('movie.toggle');

Route::get('/genre', [GenreController::class, 'index'])->name('genre');
Route::get('genre/create', [GenreController::class, 'create'])->name('genre.create');
Route::post('genre/store', [GenreController::class, 'store'])->name('genre.store');
Route::get('genre/{id}/edit', [GenreController::class, 'edit'])->name('genre.edit');
Route::post('genre/update', [GenreController::class, 'update'])->name('genre.update');
Route::get('genre/{genre}/delete', [GenreController::class, 'destroy'])->name('genre.destroy');


