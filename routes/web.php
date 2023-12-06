<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RiwayatController;

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
