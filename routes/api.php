<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createtodo',[TodoController::class, 'create']);
Route::get('/displaytodos',[TodoController::class, 'display']);
Route::get('/edittodo/{id}',[TodoController::class, 'edit']);
Route::post('/updatetodo/{id}',[TodoController::class, 'update']);
Route::post('/checkboxtodo/{id}',[TodoController::class, 'checkComplete']);
Route::delete('/deletetodo/{id}',[TodoController::class, 'destroy']);