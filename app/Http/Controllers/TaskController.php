<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $response = Task::where('user_id', $user->id)->latest()->get();
        return response()->json($response, 200);
    }

    public function store(TaskRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['user_id'] = $user->id;
        $response = Task::create($data);
        return response()->json($response, 201);
    }

    public function show(Task $task)
    {
        $user = auth()->user();
        if ($user->id == $task->user_id) {
            $response = $task;
            return response()->json($response, 200);
        }else {
            abort(403);
        }
    }

    public function update(TaskRequest $request, Task $task)
    {
        $user = auth()->user();
        if ($user->id == $task->user_id) {
            $data = $request->validated();
            $task->update($data);
            $response = $task;
            return response()->json($response, 200);
        }else {
            abort(403);
        }
    }

    public function changeStatus(Task $task, Request $request)
    {
        $user = auth()->user();
        if ($user->id == $task->user_id) {
            $task->done = $request->done;
            $rask->save();
            return response(null, 200);
        }else {
            abort(403);
        }
    }

    public function destroy(Task $task)
    {
        $user = auth()->user();
        if ($user->id == $task->user_id) {
            $task->delete();
            return response(null, 204);
        }else {
            abort(403);
        }
    }
}
