<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    //
public function index()
{
    $tasks = Task::all();
    return response()->json($tasks);
}

public function store(Request $request)
{
    $task = new Task;
    $task->name = $request->name;
    $task->status_id = $request->status_id;
    $task->save();
    $task->users()->sync($request->users);
    return response()->json($task);
}

public function show(Task $task)
{
    return response()->json($task);
}

public function update(Request $request, Task $task)
{
    $task->name = $request->name;
    $task->status_id = $request->status_id;
    $task->save();
    $task->users()->sync($request->users);
    return response()->json($task);
}

public function destroy(Task $task)
{
    $task->delete();
    return response()->json(null, 204);
}



}
