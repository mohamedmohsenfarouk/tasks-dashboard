<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
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

// Route::group(['middleware' => ['jwt.verify']], function () {
// Route::get('logout', [AuthController::class, 'logout']);
Route::get('get_user', [AuthController::class, 'get_user']);
Route::get('tasks/all', [TasksController::class, 'all']);
Route::get('tasks/{id}', [TasksController::class, 'show']);
Route::post('create', [TasksController::class, 'store']);
Route::post('update/{task}', [TasksController::class, 'update']);
Route::delete('delete/{task}', [TasksController::class, 'destroy']);
// });
