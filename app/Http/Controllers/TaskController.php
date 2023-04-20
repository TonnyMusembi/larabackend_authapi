<?php

namespace App\Http\Controllers;
use App\Models\Task;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index(){
         $tasks = Task::latest()->paginate(10);
          return response()->json([
            "status" => 200,
            "data" => $tasks ]);





    }

}
