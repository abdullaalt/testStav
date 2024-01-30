<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\V1\RequestsController;
use App\Http\Controllers\V1\UserController;
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

Route::post('/requests', [RequestsController::class, 'store']);

Route::middleware(['auth:sanctum', 'VerifyCsrfToken'])->group(function () {
    
    Route::put('/requests', [RequestsController::class, 'update']);
    Route::get('/requests/my', [RequestsController::class, 'myRequests']);
    Route::get('/requests', [RequestsController::class, 'requests']);
    Route::get('/requests/{request_id}', [RequestsController::class, 'request']);
    Route::delete('/requests/{request_id}', [RequestsController::class, 'delete']);
});


Route::prefix('auth')->namespace('API')->group(function() {
    //Route::middleware('auth:sanctum')->post('register', 'AuthController@register');
    Route::post('login', [AuthenticatedSessionController::class, 'token']);
});

Route::get('/auth/gosuslugi', [UserController::class, 'authGosUslugi']);
