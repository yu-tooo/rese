<?php

use App\Http\Controllers\User\AuthenticatedSessionController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\RegisteredUserController;
use App\Http\Controllers\User\RestaurantController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RestaurantController::class, 'index'])
->name('home');
Route::get('/detail/{id}', [RestaurantController::class, 'detail'])
->name('detail');

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:users')->group(function () {
    Route::post('/detail/{id}', [RestaurantController::class, 'reserve']);

    Route::get('/reservation/{id}', [RestaurantController::class, 'change'])
    ->name('reservation');

    Route::post('/reservation/{id}', [RestaurantController::class, 'update']);

    Route::get('/mypage', [UserController::class, 'show'])
    ->name('mypage');

    Route::post('/mypage', [UserController::class, 'delete']);

    Route::post('/like/create/{id}', [LikeController::class, 'create'])
    ->name('like.create');
    
    Route::post('/like/delete/{id}', [LikeController::class, 'delete'])
    ->name('like.delete');

    Route::get('/comment/{id}', [CommentController::class, 'show'])
    ->name('comment');
    
    Route::post('/comment/{id}', [CommentController::class, 'create']);

    Route::get('/comment/edit/{id}', [CommentController::class, 'edit'])
    ->name('recomment');

    Route::post('/comment/edit/{id}', [CommentController::class, 'update']);

    Route::post('/comment/delete/{id}', [CommentController::class, 'delete'])
    ->name('delcomment');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
