<?php

use App\Http\Controllers\Api\GameApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Games API Routes
Route::get('/games', [GameApiController::class, 'index']);
Route::get('/games/{game}', [GameApiController::class, 'show']);

// Additional endpoints
Route::get('/genres', [GameApiController::class, 'genres']);
Route::get('/topRated', [GameApiController::class, 'topRated']);
Route::get('/platforms', [GameApiController::class, 'platforms']);
Route::get('/tags', [GameApiController::class, 'tags']);
