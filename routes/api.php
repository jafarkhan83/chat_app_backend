<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/users', [ChatController::class, 'getUsers']);
Route::get('/messages/{user_id}', [ChatController::class, 'getMessages']);
Route::post('/messages', [ChatController::class, 'sendMessage']);