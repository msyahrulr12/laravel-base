<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BoardOfManagementController;
use App\Http\Controllers\Admin\CardMemberController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentationController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RegulationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\Admin\WorkProgramController;
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
        Route::resource('regions', RegionController::class);
        Route::resource('users', UserController::class);
        Route::resource('regulations', RegulationController::class);
        Route::resource('vision_missions', VisionMissionController::class);
        Route::resource('forms', FormController::class);
        Route::resource('documentations', DocumentationController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('work_programs', WorkProgramController::class);
        Route::resource('board_of_managements', BoardOfManagementController::class);
        Route::resource('about_us', AboutUsController::class);
        Route::resource('contact_us', ContactUsController::class);
        Route::resource('social_media', SocialMediaController::class);
        Route::resource('card_members', CardMemberController::class);

        Route::name('users.')->prefix('users')->group(function() {
            Route::get('card/generate/{userId}', [UserController::class, 'generateCard'])->name('generate');
            Route::get('qr-code/generate/{userId}', [UserController::class, 'generateQrCode'])->name('generate-qr-code');
        });

        Route::prefix('card_members')->name('card_members.')->group(function() {
            Route::get('generate/{id}', [CardMemberController::class, 'generateExampleCard'])->name('generate');
        });
    });

});
