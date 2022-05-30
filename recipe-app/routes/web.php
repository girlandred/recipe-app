<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CuisinesController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('recipes', RecipeController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
//     Route::get('/', [AdminController::class, 'index'])->name('index');

// });

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::resource('ingredients', IngredientController::class);
    Route::resource('cuisines', CuisinesController::class);
});


require __DIR__ . '/auth.php';
