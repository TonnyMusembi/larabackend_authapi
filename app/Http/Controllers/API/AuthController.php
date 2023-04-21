<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $user = User::create([
                // 'first_name' => $request->input('first_name'),
                // 'last_name' => $request->input('last_name'),
                'email_adress' => $request->input('email_adress'),
                'password' => Hash::make($request->input('password'))
            ]);

            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([ 'user' => $user, 'token' => $token ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ]);
        }


    //     $fields = $request->validate([

    //         'email_adress' => $request->input('email_adress'),
    //         'password' => Hash::make($request->input('password'))
    //     ]);

    //     $user = User::create([

    //         'email_adress' => $fields['email_adress'],
    //         'password' => bcrypt($fields['password'])
    //     ]);

    //     $token = $user->createToken('myapptoken')->plainTextToken;

    //     $response = [
    //         'user' => $user,
    //         'token' => $token
    //     ];

    //     return response($response, 201);
    }

    public function login(Request $request)
    {

   $fields = $request->validate([
            'email_adress' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email_adress', $fields['email_adress'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);}

    public function logout(Request $request)

    {
        try {

            $user = User::findOrFail($request->input('user_id'));

            $user->tokens()->delete();

            return response()->json('User logged out!', 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.logout'
            ]);
        }
    }
}
