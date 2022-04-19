<?php

use App\Http\Controllers\CvController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function () {
        return Auth::user()->name;
    });

    Route::post('/portfolio', [PortfolioController::class, 'store']);
    Route::put('/portfolio/update/{id}', [PortfolioController::class, 'update']);
    Route::delete('/portfolio/delete/{id}', [PortfolioController::class, 'destroy']);

    Route::post('/upload/cv', [CvController::class, 'store']);

    Route::delete('/logout', [LogoutController::class, 'destroy']);
});

Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/portfolio/{id}', [PortfolioController::class, 'show']);

Route::get('/download/cv', [CvController::class, 'download']);

Route::post('/login', [LoginController::class, 'store']);
