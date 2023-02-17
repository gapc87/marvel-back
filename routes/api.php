<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarvelController;
use App\Http\Controllers\TeamController;

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

Route::get('marvel-hash', MarvelController::class);


Route::group([
    'prefix' => 'auth',
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::get('refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('logout', [AuthController::class, 'logout']);

});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::delete('team/{hero}', [TeamController::class, 'deleteHero']);
    Route::resource('team', TeamController::class)->only('index', 'destroy');
    Route::get('team/{field}', [TeamController::class, 'getHero']);
    Route::put('team/{field}', [TeamController::class, 'update']);
});