<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;


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

Route::redirect('/', 'login');

Route::get('locale/{locale}', [LanguageController::class, 'changeLocale'])->name('locale');
Route::middleware(['set_locale'])->group(function () {
    Route::resource('recipes', RecipeController::class);


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::group(['prefix' => 'user', 'as' => 'user'], function () {
        Route::get('/{user}', [UserController::class, 'index'])->name('.index');
        Route::post('/{user}', [UserController::class, 'store']);
    });

    Route::group(['prefix' => 'specifications', 'as' => 'specifications'], function () {
        Route::get('/{specification}', [SpecificationController::class, 'show'])->name('.index');
    });

    Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'adminDashboard'])->name('dashboard');
        Route::resource('ingredients', IngredientController::class);
        Route::resource('specifications', SpecificationController::class);
    });

    require __DIR__ . '/auth.php';
});
