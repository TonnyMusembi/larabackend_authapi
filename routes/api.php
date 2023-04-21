<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// public apis
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);



Route::get('tasks', [TasksController::class, 'index']);
  Route::get('/users', [UserController::class, 'index']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('tasks', [TasksController::class, 'store']);
});





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});






