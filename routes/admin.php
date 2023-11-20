<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuHeaderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group.
|
*/

Route::name('admin.')->group(function() {
    /**
     * Authentication
     */
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    /**
     * Forgot Password
     */
    Route::get('/forgot-password', [ForgotPasswordController::class, 'requestForm'])->name('forgot-password');
    Route::post('/forgot-password/verify-email', [ForgotPasswordController::class, 'verifyEmail'])->name('forgot-password.verify-email');
    Route::get('/forgot-password/verify-token', [ForgotPasswordController::class, 'verifyToken'])->name('forgot-password.verify-token');
    Route::post('/forgot-password/change', [ForgotPasswordController::class, 'changePassword'])->name('forgot-password.change');

    /**
     * Role and Permission
     */
    Route::middleware(['auth'])->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('users', UserController::class);
        Route::resource('menu_headers', MenuHeaderController::class);
        Route::resource('menus', MenuController::class);
    });

});
