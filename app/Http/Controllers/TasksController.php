<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TasksController extends Controller
{
    protected $user;

    public function __construct()
    {
    }

    public function index()
    {
        $tasks = Tasks::all();
        return view('tasks.index', compact('tasks'));
    }

    public function all()
    {
        return $this->user
            ->tasks()
            ->paginate(5);
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
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new task
        $task = Tasks::create([
            'title' => $request->title,
            'subject' => $request->subject,
            'user_id' => isset($request->user_id) ? $request->user_id : Auth::id(),
        ]);

        return redirect('/tasks')->with('success', 'Task saved!');

        //task created, return success response
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Task created successfully',
        //         'data' => $task,
        //     ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, task not found.',
            ], 400);
        }

        return $task;
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
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update task
        $task = $task->update([
            'title' => $request->title,
            'subject' => $request->subject,
            'user_id' => isset($request->user_id) ? $request->user_id : Auth::id(),
        ]);

        //Task updated, return success response
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Task updated successfully',
        //     'data' => $task,
        // ], Response::HTTP_OK);

        return redirect('/tasks')->with('success', 'Task updated!');

    }

    public function destroy(Tasks $task)
    {
        $task->delete();

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Task deleted successfully',
        // ], Response::HTTP_OK);

        return redirect('/tasks')->with('success', 'Task deleted!');

    }

}
