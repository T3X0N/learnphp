<?php

use App\Controllers\PublicController;
use App\Route;

Route::get('/', [PublicController::class, 'index']);

Route::get('/us', [PublicController::class, 'us']);
Route::get('/tech', [PublicController::class, 'tech']);

Route::get('/test', [PublicController::class, 'test']);

Route::get('/form', [PublicController::class, 'form']);
Route::post('/answer', [PublicController::class, 'answer']);
