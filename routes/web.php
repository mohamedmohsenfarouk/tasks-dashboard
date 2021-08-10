<?php

use App\Http\Controllers\TasksController;
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

Route::get('tasks', [TasksController::class, 'index']);
Route::get('new_task', [TasksController::class, 'create'])->name('newTask');
Route::get('edit_task/{id}', [TasksController::class, 'edit'])->name('editTask');

Route::post('create', [TasksController::class, 'store'])->name('storeTask');
Route::post('update/{task}', [TasksController::class, 'update'])->name('updateTask');
Route::delete('delete/{task}', [TasksController::class, 'destroy'])->name('destroyTask');
