<?php

use App\Controllers\PublicController;
use App\Controllers\UsersController;
use App\Route;

Route::get('/', [PublicController::class, 'index']);

Route::get('/us', [PublicController::class, 'us']);
Route::get('/tech', [PublicController::class, 'tech']);

Route::get('/test', [PublicController::class, 'test']);

Route::get('/form', [PublicController::class, 'form']);
Route::post('/answer', [PublicController::class, 'answer']);

Route::get('/admin/users', [UsersController::class, 'index']);
Route::get('/admin/users/view', [UsersController::class, 'view']);
Route::get('/admin/users/edit', [UsersController::class, 'edit']);
Route::post('/admin/users/edit', [UsersController::class, 'update']);
Route::post('/admin/users/delete', [UsersController::class, 'delete']);
