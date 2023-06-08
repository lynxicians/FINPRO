<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AboutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['guest']], function()
{
    Route::get('/login', [LoginController::class, 'index'])->name("login");
    Route::post('/login', [LoginController::class, 'authenticate'])->name("login-post");

    Route::get('/register', [RegisterController::class, 'index'])->name("register");
    Route::post('/register', [RegisterController::class, 'register'])->name("register-post");

});

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', [HomepageController::class, 'index'])->name("homepage");
});

Route::get('/suggestion', [SuggestionController::class, 'index'])->name("suggestion");
Route::get('/about', [AboutController::class, 'index'])->name("about");


