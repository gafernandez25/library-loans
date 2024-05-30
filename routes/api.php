<?php

declare(strict_types=1);

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function () {
    Route::get('/book', [BookController::class, 'list']);
    Route::get('/user', [UserController::class, 'list']);
    Route::get('/loan/user', [LoanController::class, 'listUsers']);
    Route::get('/loan/book', [LoanController::class, 'listBooks']);
});
