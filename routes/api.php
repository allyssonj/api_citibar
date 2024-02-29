<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('auth.register');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('auth.login');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('auth.password.email');

    Route::group([
        'middleware' => 'auth:sanctum',
    ], function () {
        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('auth.password.store');
        Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('auth.verification.verify');
        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('auth.verification.send');
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
