<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksApiController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get_user', [AuthController::class, 'get_user']);
    Route::get('tasks', [TasksApiController::class, 'index']);
    Route::get('tasks/{id}', [TasksApiController::class, 'show']);
    Route::post('create', [TasksApiController::class, 'store']);
    Route::post('update/{task}', [TasksApiController::class, 'update']);
    Route::delete('delete/{task}', [TasksApiController::class, 'destroy']);
});
