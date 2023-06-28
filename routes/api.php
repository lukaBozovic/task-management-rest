<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\RegistrationController;
use App\Http\Controllers\api\StatusController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/test', function () {
    return \App\Models\User::all();
});
Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Example of sanctum usage
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/users/{user}', [UserController::class, 'update']);
    Route::apiResource('statuses', StatusController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/deleted-tasks', [TaskController::class, 'deletedTasks']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::patch('/tasks/{task}/change-status', [TaskController::class, 'changeStatus']);
    Route::get('tasks-by-statuses', [TaskController::class, 'getByStatuses']);

});
