<?php

use App\Http\Controllers\FollowingController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Following;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::prefix('/api')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class)->only(['show', 'update']);
    Route::apiResource('posts', PostController::class)->only(['index', 'show', 'store', 'destroy']);

    Route::post('/users/{user}/like', [LikeController::class, 'like']);
    Route::post('/users/{user}/unlike', [LikeController::class, 'unlike']);
    
    Route::post('/users/{user}/follow', [FollowingController::class, 'follow']);
    Route::post('/users/{user}/unfollow', [FollowingController::class, 'unfollow']);

    Route::get('/users/{user}/followings', [FollowingController::class, 'followings']);
    Route::get('/users/{user}/followers', [FollowingController::class, 'followers']);
});

require __DIR__.'/auth.php';
