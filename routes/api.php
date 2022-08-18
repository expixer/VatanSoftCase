<?php

use App\Http\Controllers\LogSmsController;
use App\Http\Controllers\SendSmsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware('auth:api');
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('send-sms', [SendSmsController::class, 'sendSms']);
    Route::get('log-sms', [LogSmsController::class, 'index']);
    Route::get('log-sms/{id}', [LogSmsController::class, 'show']);
});
