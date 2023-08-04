<?php

use App\Http\Controllers\Api\User\Auth\LoginController;
use App\Http\Controllers\Api\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\User\Auth\RegisterUserController;
use App\Http\Controllers\Api\User\Auth\VerifyEmailController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
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



Route::post('auth/register', RegisterUserController::class);

Route::post('auth/login', LoginController::class);

Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'sendResetLink']);
Route::post('auth/forgot-password/verify-token', [PasswordResetLinkController::class, 'verifyResetToken']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/register/verify-email', VerifyEmailController::class);

    Route::apiResource('books', BookController::class);
});
