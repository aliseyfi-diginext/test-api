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
        return response($response, 200)->withHeaders([
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS'
        ]);
    }

    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $response = Task::create($data);
    }

    public function show(Task $task)
    {
        $response = $task;
    }

    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        $response = $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        $response = response(null, 204);
    }
}
