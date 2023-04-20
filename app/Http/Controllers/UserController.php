<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //
     public function index(){
         $users = User::paginate(10);
    	return response()->json($users);
    }
    public function store(Request $request){
       $user = User::create($request->all());
        return response()->json($user, 201);

    //   return new BookResource($book);

    }
    public function show (){

    }
     public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user);
    }
    public function destroy (){
         return response()->json([
        'message' => "Phone deleted successfully!",
    ], 200);

    }
}
