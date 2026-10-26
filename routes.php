<?php

use App\Controllers\PublicController;
use App\Controllers\AuthController;
use App\Controllers\PostsController;
use App\Controllers\UsersController;
use App\Route;

Route::get('/', [PublicController::class, 'index']);

Route::get('/us', [PublicController::class, 'us']);
Route::get('/tech', [PublicController::class, 'tech']);

Route::get('/test', [PublicController::class, 'test']);

Route::get('/form', [PublicController::class, 'form']);
Route::post('/answer', [PublicController::class, 'answer']);

Route::get('/admin/posts', [PostsController::class, 'index']);
Route::get('/admin/posts/create', [PostsController::class, 'create']);
Route::post('/admin/posts', [PostsController::class, 'store']);
Route::get('/admin/posts/view', [PostsController::class, 'view']);
Route::get('/admin/posts/edit', [PostsController::class, 'edit']);
Route::post('/admin/posts/edit', [PostsController::class, 'update']);
Route::post('/admin/posts/delete', [PostsController::class, 'delete']);

Route::get('/admin/users', [UsersController::class, 'index']);
Route::get('/admin/users/view', [UsersController::class, 'view']);
Route::get('/admin/users/edit', [UsersController::class, 'edit']);
Route::post('/admin/users/edit', [UsersController::class, 'update']);
Route::post('/admin/users/delete', [UsersController::class, 'delete']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
