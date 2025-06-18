<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

Route::get('/book-cover/{filename}', function ($filename) {
    $path = storage_path('app/public/book_covers/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    return Response::file($path);
});



Route::get('/', function () {
    return view('welcome');
});
