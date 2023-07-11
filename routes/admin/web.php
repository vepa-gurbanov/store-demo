<?php

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')
    ->name('admin')
    ->group(function () {
        Route::middleware('guest:web')
            ->group(function () {
                Route::get('/auth/login', [LoginController::class, 'create'])->name('.auth.login');
                Route::post('/auth/login', [LoginController::class, 'store']);

                Route::get('/auth/register', [RegisterController::class, 'create'])->name('.auth.register');
                Route::post('/auth/register', [RegisterController::class, 'store']);

                Route::get('/auth/verify', [AuthenticationController::class, 'create'])->name('.auth.verify');
                Route::post('/auth/verify', [AuthenticationController::class, 'store']);
            });

        Route::middleware(['auth:web'])
            ->group(function () {
                Route::get('/dashboard', [DashboardController::class, 'index'])->name('.dashboard');
            });
    });

