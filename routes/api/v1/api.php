<?php

use App\Http\Controllers\api\v1\Oauth\LoginController;
use App\Http\Controllers\api\v1\Oauth\RegisterController;
use App\Http\Controllers\api\v1\Team\TeamController;
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
    Route::post('oauth/register', [RegisterController::class, 'register'])->name('auth.register');
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/team', TeamController::class);
});

