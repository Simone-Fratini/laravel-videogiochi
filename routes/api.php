<?php

use App\Http\Controllers\Api\GameApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Games API Routes
Route::prefix('games')->group(function () {
    Route::get('/', [GameApiController::class, 'index']);
    Route::get('/{game}', [GameApiController::class, 'show']);

    // Additional endpoints
    Route::get('/genres', [GameApiController::class, 'genres']);
    Route::get('/platforms', [GameApiController::class, 'platforms']);
    Route::get('/tags', [GameApiController::class, 'tags']);
});
