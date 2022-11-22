<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
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
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', [DashboardController::class, 'showDashboardPage'])->name('client.dashboard');
        Route::post('/ajax/dashboard', [DashboardController::class, 'liveChange'])->name('client.dashboard.ajax');
        /** Update User Informations **/
        Route::post('/update/user/stepOne', [DashboardController::class, 'updateInfosStepOne'])->name('update.userInfos.stepOne');
        Route::post('/update/user/stepTwo', [DashboardController::class, 'updateInfosStepTwo'])->name('update.userInfos.stepTwo');
        Route::post('/update/user/stepThree', [DashboardController::class, 'updateInfosStepThree'])->name('update.userInfos.stepThree');
        Route::post('/update/user/stepFourth', [DashboardController::class, 'updateInfosStepFourth'])->name('update.userInfos.stepFourth');
    });

    /**************** PROJECT ROUTE *****************/
    //-- Access Project Publish Page
    Route::get('/projet/publication', [ProjectController::class, 'showProjectPage'])->name('client.project.publish');
    //-- Store project
    Route::post('/projet/publication', [ProjectController::class, 'store'])->name('client.project.create');
    //-- Edit project
    Route::put('/projet/publication/edit/{id}', [ProjectController::class, 'update'])->name('client.project.edit');
    //-- Delete project
    Route::delete('/project/publication/delete/{id}', [ProjectController::class, 'delete'])->name('client.project.delete');
    //-- Like project
    Route::post('/project/likethisone', [ProjectController::class, 'projectLiked'])->name('client.project.like');
    //-- Get Projects User needs
    Route::get('/project/wished', [HomeController::class, 'switchProjects'])->name('client.project.wished');

    //-- Store Investor Entreprise Liked
    Route::post('profil/userLikeThisEntreprise', [ProfilController::class, 'saveEntrepriseToThisUser'])->name('userLikeThisEntreprise');
    //-- Store user in newsletter subscriber
    Route::post('/userWish/newsletter', [HomeController::class, 'isWishNewsletter'])->name('user.wishNewsletter');
});
//-- Show project
Route::get('/projet/{id}', [ProjectController::class, 'show'])->name('client.project.show');
//-- User Profil Page Route
Route::get('profil/{id}', [ProfilController::class, 'index'])->name('client.show.user');

/**************** COMMON FUNCTIONNALITIES ROUTES **********/
Route::post('/ajax/livesearch', [ProjectController::class, 'liveSearch'])->name('ajax.search');

