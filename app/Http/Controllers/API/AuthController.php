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

            return response()->json([ 'user' => $user, 'token' => $token ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.register'
            ]);
        }
    }

    public function login(Request $request)
    {
        try {

//             if (Auth::attempt(['email_adress' => $email_adress, 'password' => $password])) {
//     $user = Auth::user();
//     $token = $user->createToken('token-name')->accessToken;

//     return response()->json(['token' => $token]);
// } else {
//     return response()->json(['error' => 'Unauthenticated'], 401);
// }
            $user = User::where('email_adress', '=', $request->input('email_adress'))->firstOrFail();


            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([ 'user' => $user, 'token' => $token ], 200);
            }

            return response()->json([ 'error' => 'Something went wrong in login' ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.login'
            ]);
        }
    }

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
