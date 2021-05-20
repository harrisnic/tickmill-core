<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;

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

// Public Routes
Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{transaction}', [TransactionController::class, 'show']);
Route::put('/transactions/{transaction}', [TransactionController::class, 'update']);
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy']);

//Route::get('/clients', [ClientController::class, 'index']);
Route::post('/clients', [ClientController::class, 'store']);
Route::get('/clients/{client}', [ClientController::class, 'show']);
Route::put('/clients/{client}', [ClientController::class, 'update']);
Route::post('/clients/{client}/avatar', [ClientController::class, 'uploadAvatar']);
Route::get('/clients/{client}/avatar', [ClientController::class, 'downloadAvatar']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/clients', [ClientController::class, 'index']);
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
