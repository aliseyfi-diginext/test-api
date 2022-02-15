<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $response = Task::where('user_id', auth()->id())->latest()->get();
        return response()->json($response, 200);
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $response = Task::create($data);
        return response()->json($response, 201);
    }

    public function show(Task $task)
    {
        $response = $task;
        return response()->json($response, 200);
    }

    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        $response = $task;
        return response()->json($response, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response(null, 204);
    }
}
