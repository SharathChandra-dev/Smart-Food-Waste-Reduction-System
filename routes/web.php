<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodIntakeController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {

    return view('User.home');

})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminController::class, 'adminLogin'])
    ->name('admin.login');

Route::post('/admin/login-submit', [AuthController::class, 'adminLogin'])
    ->name('admin.login.submit');

Route::redirect('/admin', '/admin/login');

Route::get('/login', [AdminController::class, 'login'])
    ->name('login');

Route::get('/register', [AdminController::class, 'register'])
    ->name('register');

// Route::get('/admin', [AdminController::class, 'login'])
//     ->name('admin.login');

// Route::redirect('/admin', '/admin/login');

Route::get('/admin/register', [AdminController::class, 'register'])
    ->name('admin.register');

Route::post('/login-submit', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/register-submit', [AuthController::class, 'register'])
    ->name('register.submit');

Route::get('/2fa/setup', [AuthController::class, 'show2faSetup'])
    ->middleware('auth')
    ->name('2fa.setup');

Route::post('/2fa/setup', [AuthController::class, 'verify2faSetup'])
    ->middleware('auth')
    ->name('2fa.setup.verify');

Route::post('/2fa/setup/regenerate', [AuthController::class, 'regenerate2faSecret'])
    ->middleware('auth')
    ->name('2fa.setup.regenerate');

Route::get('/2fa/verify', [AuthController::class, 'show2faVerify'])
    ->name('2fa.verify');

Route::post('/2fa/verify', [AuthController::class, 'verify2faLogin'])
    ->name('2fa.verify.submit');

Route::post('/contact-submit', [ContactController::class, 'store'])
    ->name('contact.submit');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users');

    Route::post('/admin/users/store', [AdminController::class, 'store'])
        ->name('admin.users.store');

    Route::put('/admin/users/update/{id}', [AdminController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/delete/{id}', [AdminController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::middleware(RoleMiddleware::class . ':Admin')->group(function () {
        Route::get('/admin/food', [FoodController::class, 'adminIndex'])
            ->name('admin.food');

        Route::get('/admin/pending-food', [AdminController::class, 'pendingFood'])
            ->name('admin.pending.food');

        Route::post('/admin/food/store', [FoodController::class, 'store'])
            ->name('admin.food.store');

        Route::put('/admin/food/update/{id}', [FoodController::class, 'update'])
            ->name('admin.food.update');

        Route::delete('/admin/food/delete/{id}', [FoodController::class, 'destroy'])
            ->name('admin.food.destroy');
    });

    Route::post('/admin/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');

    Route::middleware(RoleMiddleware::class . ':Admin')->group(function () {
        Route::get('/admin/contacts', [ContactController::class, 'index'])
            ->name('admin.contacts');

        Route::post('/admin/contacts/reply/{contact}', [ContactController::class, 'reply'])
            ->name('admin.contacts.reply');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/foods', [FoodController::class, 'userIndex'])
        ->name('foods.index');

    Route::get('/foods/details/{id}', function ($id) {
        return view('User.foods.details');
    })->name('foods.details');

    Route::get('/foods/create', function () {
        return view('User.foods.create');
    })->name('foods.create');
});

Route::get('/my-foods', function () {
    return view('User.foods.myfoods');
})->name('foods.myfoods');

Route::get('/orders', function () {
    return view('User.orders.index');
})->name('orders.index');

Route::get('/profile', function () {
    return view('User.profile.index');
})->name('profile.index');

Route::get('/my-posts', function () {
    return view('User.posts.index');
})->name('posts.index');

Route::get('/admin/headers', [AdminController::class, 'headers'])
    ->name('admin.headers');

Route::post('/admin/headers/store', [AdminController::class, 'storeHeader'])
    ->name('admin.headers.store');

Route::put('/admin/headers/update/{id}', [AdminController::class, 'updateHeader'])
    ->name('admin.headers.update');

Route::delete('/admin/headers/delete/{id}', [AdminController::class, 'deleteHeader'])
    ->name('admin.headers.delete');
/*
|--------------------------------------------------------------------------
| FOOD INTAKE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::post('/food-intake/store', [FoodIntakeController::class, 'store'])
        ->name('intake.store');

    Route::get('/food-intake/my-intakes', [FoodIntakeController::class, 'userIntakes'])
        ->name('intake.user');

    Route::get('/food-intake/consumed', [FoodIntakeController::class, 'consumedFoods'])
        ->name('intake.consumed');

    Route::get('/food-intake/expiring', [FoodIntakeController::class, 'expiringFoods'])
        ->name('intake.expiring');

    Route::put('/food-intake/update/{id}', [FoodIntakeController::class, 'update'])
        ->name('intake.update');

    Route::delete('/food-intake/delete/{id}', [FoodIntakeController::class, 'destroy'])
        ->name('intake.destroy');
});

Route::middleware(['auth', RoleMiddleware::class . ':Admin'])->group(function () {
    Route::get('/admin/food-intake', [FoodIntakeController::class, 'index'])
        ->name('admin.intake.index');
});

