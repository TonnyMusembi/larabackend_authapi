<?php

namespace App\Http\Controllers;
// use App\Models\Task;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    //
    public function index(){
         $task = Task::latest()->paginate(10);
          return response()->json([
            "status" => 200,
            "data" => $task ]);


    }
    public function store(Request $request){
       $task = Task::create($request->all());
        return response()->json($task, 201);

    //   return new BookResource($book);

    }

}
