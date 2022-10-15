<?php

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

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'apiLogin']);

Route::middleware('auth:sanctum')->group(
    function () {
            Route::get('/logout-app', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

        Route::post('/generate', [\App\Http\Controllers\ScratchCodesController::class, 'generateJsonBatch'])->name('generate');
    });
Route::post('/consume', [\App\Http\Controllers\ScratchCodesController::class, 'destroy'])->name('consume');
