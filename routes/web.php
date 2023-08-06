<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
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
    Route::get('/search-blog', [SearchController::class, 'search'])->name("search-suggestion");

});

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/suggestion/detail/{id}', [SuggestionController::class, 'SuggestionShow'])->name('suggestion.show');
    Route::get('/suggestion-management', [SuggestionController::class, 'userManagement'])->name('suggestion.management');
    Route::post('/comment', [CommentController::class, 'Comment'])->name('comment');
    Route::post('/like', [CommentController::class, 'like'])->name('suggestion.like');
    Route::get('/suggestion-mannagement', [SuggestionController::class, 'getUsersData'])->name('suggestion.data');
    Route::get('/suggestion-edit', [SuggestionController::class, 'suggestionEdit'])->name('suggestion.edit');
    Route::delete('/suggestion-delete/{id}', [SuggestionController::class, 'suggestionDelete'])->name('suggestion.delete');
    Route::get('/SuggestionManagementSystem', [SuggestionController::class, 'SuggestionManagementSystem'])->name('suggestion.SuggestionManagementSystem');
    Route::get('/suggestion', [SuggestionController::class, 'index'])->name("suggestion");
    Route::post('/suggestion', [SuggestionController::class, 'store'])->name("suggestion-post");
    Route::post('/userUpdate', [SuggestionController::class, 'UserUpdate'])->name("userUpdate");
    Route::get('/notification', [NotificationController::class, 'notification'])->name("notification");
    Route::get('/logout', [LoginController::class, 'logout'])->name("logout");

    Route::post('/notifsuccess/{id}', [NotificationController::class, 'notifsuccess'])->name("notification.success");
    Route::post('/notiffailed/{id}', [NotificationController::class, 'notiffailed'])->name("notification.failed");
});

Route::group(['middleware' => ['AdminLogin']], function()
{
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.index');
});
Route::get('/about', [AboutController::class, 'index'])->name("about");
Route::get('/', [HomepageController::class, 'index'])->name("homepage");


