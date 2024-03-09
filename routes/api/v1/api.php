<?php

use App\Http\Controllers\api\v1\Oauth\LoginController;
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

Route::middleware(['guest', 'localization'])->group(function () {
    Route::post('oauth/login', [LoginController::class, 'login'])->name('auth.login');
});

