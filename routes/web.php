<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardUserController;

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
