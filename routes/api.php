<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::get('/todos/{id}', [TodoController::class, 'get'])->middleware('jwtsecure');
Route::get('/users/{id}/todos', [TodoController::class, 'getUserTodos'])->middleware('jwtsecure');

Route::post('/todos', [TodoController::class, 'create'])->middleware('jwtsecure');
Route::put('/todos/{id}', [TodoController::class, 'update'])->middleware('jwtsecure');
Route::delete('/todos/{id}', [TodoController::class, 'delete'])->middleware('jwtsecure');
