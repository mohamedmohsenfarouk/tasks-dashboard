<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class TasksApiController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index()
    {
        return $this->user
            ->tasks()
            ->paginate(5);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        //Validate data
        $data = $request->only('title', 'subject', 'user_id');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'subject' => 'required',
            'user_id' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new task
        $task = $this->user->tasks()->create([
            'title' => $request->title,
            'subject' => $request->subject,
            'user_id' => $request->user_id,
        ]);

        //task created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => $task,
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $task = $this->user->tasks()->find($id);

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

    }

    public function update(Request $request, Tasks $task)
    {
        //Validate data
        $data = $request->only('title', 'subject', 'user_id');
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'subject' => 'required',
            'user_id' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, update task
        $task = $task->update([
            'title' => $request->title,
            'subject' => $request->subject,
            'user_id' => $request->user_id,
        ]);

        //Task updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'data' => $task,
        ], Response::HTTP_OK);
    }

    public function destroy(Tasks $task)
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully',
        ], Response::HTTP_OK);
    }

}
