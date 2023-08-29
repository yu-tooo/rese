<?php

use App\Http\Controllers\Owner\AuthenticatedSessionController;
use App\Http\Controllers\Owner\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:owners')->group(function () {
  Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:owners')->group(function () {
  Route::get('/', [RestaurantController::class, 'index'])
  ->name('home');

  Route::get('/detail/{id}', [RestaurantController::class, 'detail'])
  ->name('detail');

  Route::post('/detail/{id}', [RestaurantController::class, 'update']);

  Route::post('/restaurant/create', [RestaurantController::class, 'create'])
  ->name('create');

  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});
