<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\DashboardController;
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
    return view('home');
});

Route::group(['middleware' => 'guest'], function() {
    Route::get('/connexion', [AuthController::class, 'showLoginPage'])->name('login');
    // Login user
    Route::post('/connexion', [AuthController::class, 'login'])->name('auth.login');

    Route::get('/inscription', [AuthController::class, 'showSigninPage'])->name('signin');
    // Store user
    Route::post('/inscription', [AuthController::class, 'register'])->name('auth.signin');
});

Route::group(['middleware' => 'auth'], function() {
    // Logout user
    Route::get('/userWish/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Access Dashboard
    Route::get('/dashboard', [DashboardController::class, 'showDashboardPage'])->name('client.dashboard');
});

