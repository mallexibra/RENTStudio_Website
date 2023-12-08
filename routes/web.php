<?php

use App\Http\Controllers\DashboardAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;

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

// ROUTE FOR USERS
// Dashboard
Route::get('/', [DashboardUserController::class, 'index']);
Route::get('/studio/{id}', [DashboardUserController::class, 'show']);
Route::get('/studio/{id}/booking', [DashboardUserController::class, 'booking']);
Route::post("/studio/{id}/booking", [DashboardUserController::class, "bookingnow"]);

// Riwayat
Route::get("/history", [RiwayatController::class, 'index']);

// Review
Route::get("/review", [ReviewController::class, 'index']);
Route::get("/review/add/{id}", [ReviewController::class, 'create']);
Route::post("/review/add/{id}", [ReviewController::class, 'store']);

// Profile
Route::get("/profile/edit/{id}", [UserController::class, 'edit']);
Route::post("/profile/edit/{id}", [UserController::class, 'update']);


// ROUTE FOR ADMIN
// Dashboard
Route::get("/admin", [DashboardAdminController::class, 'index']);

// Studio
Route::get('/admin/studio', [StudioController::class, 'index']);
Route::get('/admin/studio/create', [StudioController::class, 'create']);
Route::post('/admin/studio/create', [StudioController::class, 'store']);
Route::get('/admin/studio/edit/{id}', [StudioController::class, 'edit']);
Route::post('/admin/studio/edit/{id}', [StudioController::class, 'update']);
Route::delete('/admin/studio/delete/{id}', [StudioController::class, 'destroy']);

// Payment
Route::get('/admin/payment', [RiwayatController::class, 'adminindex']);

// Review
Route::get('/admin/review', [ReviewController::class, 'adminindex']);

// Account
Route::get("/admin/account", [UserController::class, 'adminindex']);
