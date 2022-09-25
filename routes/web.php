<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\HomeController;
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
//Home
Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

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
    Route::get('/userwish/logout', [AuthController::class, 'logout'])->name('auth.logout');

    /**************** DASHBOARD ROUTE *****************/
    // Access Dashboard
    Route::get('/dashboard', [DashboardController::class, 'showDashboardPage'])->name('client.dashboard');
    /**************** END DASHBOARD ROUTE *****************/

    /**************** PROJECT ROUTE *****************/
    //-- Access Project Publish Page
    Route::get('/projet/publication', [ProjectController::class, 'showProjectPage'])->name('client.project.publish');
    //-- Show project
    Route::get('/projet/{id}', [ProjectController::class, 'show'])->name('client.project.show');
    //-- Store project
    Route::post('/projet/publication', [ProjectController::class, 'store'])->name('client.project.create');
    //-- Edit project
    Route::put('/projet/publication/edit/{id}', [ProjectController::class, 'update'])->name('client.project.edit');
    //-- Delete project
    Route::delete('/project/publication/delete/{id}', [ProjectController::class, 'delete'])->name('client.project.delete');
    /**************** END PROJECT ROUTE *****************/


});

