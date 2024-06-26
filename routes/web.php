<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['api_auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/city/{id}', [CityController::class, 'show'])->name('city.show');
    
    Route::prefix('weather')->group(function () {
        Route::get('/search', [CityController::class, 'index'])->name('weather.search');
        Route::get('/', [WeatherController::class, 'index'])->name('weather.index');
    });
});
