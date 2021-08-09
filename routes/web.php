<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\Tasks;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $tasks = Tasks::where('user_id', Auth::id())->paginate(5);
    return view('dashboard', compact('tasks'));
})->name('dashboard');

Route::get('tasks', [AuthController::class, 'indexTasks']);
Route::get('new_task', [DashboardController::class, 'newTask'])->name('newTask');
Route::get('edit_task/{id}', [DashboardController::class, 'editTask'])->name('editTask');
