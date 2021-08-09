<?php

namespace App\Http\Controllers;

use App\Models\Tasks;

class DashboardController extends Controller
{
    public function newTask()
    {
        return view('tasks.create');
    }

    public function editTask($id)
    {
        $task = Tasks::find($id);
        return view('tasks.edit', compact('task'));
    }
}
