<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CurrencyController;

Route::post('register', [AuthController::class, 'register'])->name("register");
Route::post('login', [AuthController::class, 'login'])->name("login");

Route::middleware("auth:api")->group(function () {
    Route::get('currency-rates', [CurrencyController::class, 'getCurrencyRates']);
});
