<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    protected $user;

    public function index()
    {
        $tasks = Tasks::where('user_id', Auth::id())->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('title', 'subject');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'subject' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return Redirect::to('new_task')->withErrors($validator);
        }

        //Request is valid, create new task
        $task = Tasks::create([
            'title' => $request->title,
            'subject' => $request->subject,
            'user_id' => Auth::id(),
        ]);

        return redirect('/tasks')->with('success', 'Task saved!');
    }

    public function edit($id)
    {
        $task = Tasks::find($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Tasks $task)
    {
        //Validate data
        $data = $request->only('title', 'subject');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'subject' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return Redirect::to('edit_task/' . $task->id)->withErrors($validator);
        }

        //Request is valid, update task
        $task = $task->update([
            'title' => $request->title,
            'subject' => $request->subject,
            'user_id' => Auth::id(),
        ]);

        //Task updated, return success response
        return redirect('/tasks')->with('success', 'Task updated!');

    }

    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect('/tasks')->with('success', 'Task deleted!');
    }

}
