<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company');
Route::get('/scratch_codes_batches', [\App\Http\Controllers\ScratchCodesController::class, 'index'])->name('scratch_codes_batches');
Route::get('/batch_details/{export_patch}', [\App\Http\Controllers\BatchDetailsController::class, 'show'])->name('batch_details');
Route::get('/batch_details/{export_patch}/export', [\App\Http\Controllers\BatchController::class, 'export'])->name('export_a_batch');
Route::get('/users' , [\App\Http\Controllers\UserController::class,'index'])->name('users');

Route::post('/company/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('create_company');
Route::post('/scratch_codes_batches', [\App\Http\Controllers\ScratchCodesController::class, 'store'])->name('create_batch');
Route::post('/users/create',[\App\Http\Controllers\UserController::class, 'store'])->name('create_user');
