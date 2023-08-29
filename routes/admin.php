<?php

use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')->group(function () {
  Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->group(function () {
  Route::get('/', [RestaurantController::class, 'index'])
  ->name('home');

  Route::get('/detail/{id}', [RestaurantController::class, 'detail'])
  ->name('detail');

  Route::post('/detail/{id}', [RestaurantController::class, 'update']);

  Route::post('/restaurant/create', [RestaurantController::class, 'create'])
  ->name('create');
  
  Route::post('/comment/delete/{id}', [CommentController::class, 'delete'])
  ->name('delcomment');

  Route::get('/owners', [UserController::class, 'show'])
  ->name('owners');

  Route::post('/owners', [UserController::class, 'store']);

  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});
