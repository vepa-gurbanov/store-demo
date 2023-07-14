<?php

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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
                Route::get('/auth/register', [RegisterController::class, 'create'])->name('.auth.register');
                Route::post('/auth/register', [RegisterController::class, 'store']);

                Route::get('/auth/check', [AuthenticationController::class, 'stepOne'])->name('.auth.check');
                Route::post('/auth/check', [AuthenticationController::class, 'check']);
                Route::get('/auth/verify', [AuthenticationController::class, 'stepTwo'])->name('.auth.verify');
                Route::post('/auth/verify', [AuthenticationController::class, 'verify']);
            });

        Route::middleware(['auth:web'])
            ->group(function () {
                Route::post('/auth/logout', [AuthenticationController::class, 'destroy'])->name('.auth.logout');

                Route::get('/dashboard', [DashboardController::class, 'index'])->name('.dashboard');
                Route::get('/users', [UserController::class, 'index'])->name('.users');
            });
    });

