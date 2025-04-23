<?php

use Illuminate\Support\Facades\Route; //Route là Facade dùng để định nghĩa route
use App\Http\Controllers\HelloController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello-xinchao', function () {
    return response()->json(['message' => 'xinchao']);
});



Route::get('/users', [UserController::class, 'index']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::post('/users', [UserController::class, 'addusers']);

Route::put('/users/{id}', [UserController::class, 'update']);     

Route::delete('/users/{id}', [UserController::class, 'delete']); 


