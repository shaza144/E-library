<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\PublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ------------------------- Auth  -------------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

    // -------------------------  Protected Routes  -------------------------

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // ------------------------- Author  -------------------------

    Route::post('/authors', [AuthorController::class, 'store']);      // إضافة
    Route::put('/authors/{id}', [AuthorController::class, 'update']); // تعديل
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy']); // حذف
    // ------------------------- Publisher  -------------------------

     Route::post('/publishers', [PublisherController::class, 'store']);
    Route::put('/publishers/{id}', [PublisherController::class, 'update']);
    Route::delete('/publishers/{id}', [PublisherController::class, 'destroy']);
    // ------------------------- Book  -------------------------

    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

});

    // ------------------------- Public Routes  -------------------------

    // ------------------------- Author  -------------------------

Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/search', [AuthorController::class, 'search']);
Route::get('/authors/{id}/books', [AuthorController::class, 'books']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);

    // ------------------------- Publisher  -------------------------

Route::get('/publishers', [PublisherController::class, 'index']);
Route::get('/publishers/search', [PublisherController::class, 'search']);
Route::get('/publishers/{id}/books', [PublisherController::class, 'books']);
    // ------------------------- Book  -------------------------

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/search', [BookController::class, 'search']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');









