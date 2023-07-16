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
                Route::get('/auth0', [RegisterController::class, 'create'])->name('.auth.register');
                Route::post('/auth0', [RegisterController::class, 'store']);
                Route::get('/auth/wait', [RegisterController::class, 'wait'])->name('.auth.wait');

                Route::get('/auth1', [AuthenticationController::class, 'stepOne'])->name('.auth.check');
                Route::post('/auth1', [AuthenticationController::class, 'check']);
                Route::get('/auth2', [AuthenticationController::class, 'stepTwo'])->name('.auth.verify');
                Route::post('/auth2', [AuthenticationController::class, 'verify']);
            });

        Route::middleware(['auth:web'])
            ->group(function () {
                Route::post('/auth/logout', [AuthenticationController::class, 'destroy'])->name('.auth.logout');

                Route::get('/dashboard', [DashboardController::class, 'index'])->name('.dashboard');
                Route::get('/users', [UserController::class, 'index'])->name('.users');
            });
    });

