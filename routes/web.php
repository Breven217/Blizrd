<?php

use App\Http\Controllers\InstallationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\NavController;

Route::get('/', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/login', [LoginController::class, 'checkLogin']);

Route::get('/login', [NavController::class, 'goLogin']);
Route::get('/home', [NavController::class, 'goHome']);
Route::get('/management', [NavController::class, 'goManagement']);
Route::get('/installations', [NavController::class, 'goInstallations']);

Route::get('/current_weather', [WeatherController::class, 'getCurrentWeather']);
Route::get('/forecast', [WeatherController::class, 'getForecast']);

Route::post('/update_user', [ManagementController::class, 'updateUser']);
Route::post('/delete_user', [ManagementController::class, 'deleteUser']);
Route::get('/search_users', [ManagementController::class, 'searchUsers']);
Route::get('/get_user', [ManagementController::class, 'getUser']);

Route::get('/get_installations', [InstallationsController::class, 'getOutstandingInstallations']);
Route::get('/get_installation_options', [InstallationsController::class, 'getInstallationOptions']);
Route::post('/mark_installation_paid', [InstallationsController::class, 'markPaid']);
Route::post('/create_installation', [InstallationsController::class, 'createInstallation']);



