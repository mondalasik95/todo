<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//controller namespace we are going to use
use App\Http\Controllers\TodoController;

Route::get('/todos',[TodoController::class,'getAllTodos']);
Route::get('/todo/edit/{id}',[TodoController::class,'getTodoById']);
Route::post('/todo/search',[TodoController::class,'getTodoByTitle']);
Route::post('/todo/sort',[TodoController::class,'makeSort']);
Route::post('/todo',[TodoController::class,'addTodo']);
Route::any('/todo/{id}',[TodoController::class,'updateTodo']);
Route::delete('/todo/delete/{id}',[TodoController::class,'deleteTodo']);

use App\Http\Controllers\AjaxController;
Route::get('/',[AjaxController::class,'index']);
Route::get('/users',[AjaxController::class,'users']);

use App\Http\Controllers\UserController;
Route::post('/users/signup',[UserController::class,'signup']);
Route::post('/users/signin',[UserController::class,'login']);
Route::get('/users/logout',[UserController::class,'logout']);
route::get('/users/todos/{user_id}',[UserController::class,'getTodoByUser']);