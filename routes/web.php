<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\QrCodeReceiverController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/scan', [QrCodeReceiverController::class, 'scan'])->name('scan');
Route::get('/portofolios', [PortofolioController::class, 'index'])->name('portofolios.index');
Route::get('/portofolios/{id}', [PortofolioController::class, 'show'])->name('portofolios.show');
Route::get('/documentations', [DocumentationController::class, 'index'])->name('documentations.index');
Route::get('/documentations/{id}', [DocumentationController::class, 'show'])->name('documentations.show');
Route::get('/members/regulation', [MemberController::class, 'regulation'])->name('members.regulation');
Route::get('/members/download-form', [MemberController::class, 'downloadForm'])->name('members.download-form');
Route::get('/members/board-of-management', [MemberController::class, 'boardOfManagement'])->name('members.board-of-management');
// Route::redirect('/', 'admin/login');

// Route::prefix('admin')->name('admin.')->group(function() {
//     // auth
//     Route::get('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');

//     Route::middleware(['auth'])->group(function() {
//         // roles
//         Route::resource('/roles', RoleController::class);
//     });
// });
