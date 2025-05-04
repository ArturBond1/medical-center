<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/test', [TestController::class, 'index']);
Route::get('/api/test/{id}', [TestController::class, 'show']);
Route::post('/api/test', [TestController::class, 'store'])->withoutMiddleware([VerifyCsrfToken::class]);
