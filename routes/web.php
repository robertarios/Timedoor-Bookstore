<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RatingController;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/top-authors', [AuthorController::class, 'topAuthors'])->name('authors.top');
Route::get('/rate-book', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/rate-book', [RatingController::class, 'store'])->name('ratings.store');
Route::get('/get-books-by-author/{authorId}', [RatingController::class, 'getBooksByAuthor']);
