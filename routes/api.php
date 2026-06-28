<?php

use App\Http\Controllers\Api\FoodApiController;
use Illuminate\Support\Facades\Route;

Route::get('/foods', [FoodApiController::class, 'index'])
    ->name('api.foods.index');

Route::get('/foods/{id}', [FoodApiController::class, 'show'])
    ->name('api.foods.show');
