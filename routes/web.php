<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingsController;
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

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/authors-top', [AuthorController::class, 'index'])->name('author.index');
Route::get('/rating/create', [RatingsController::class, 'create'])->name('rating.create');
Route::post('/rating', [RatingsController::class, 'store'])->name('rating.store');
Route::get('/books/by-author/{author}', [RatingsController::class, 'getBooksByAuthor']);
