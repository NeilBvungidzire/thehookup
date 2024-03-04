<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

// Home route
Route::get('/', function () {
    return view('feeds.index');
})->name('home');

// Authentication routes
Route::post('/users/register', [RegisterController::class, 'register'])->name('register.submit');
Route::post('/users/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/users/logout', [LogoutController::class, 'logout'])->middleware('auth')->name('logout');

// Profile routes
Route::group(['prefix' => 'profile', 'middleware' => 'auth'], function () {
    /**
     * Profile Index
     */
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');

    /**
     * Create Profile
     */
    Route::get('/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/store', [ProfileController::class, 'store'])->name('profile.store');

    /**
     * Edit Profile
     */
    Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

    /**
     * Delete Profile
     */
    Route::delete('/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Show Profile
     */
    Route::get('/show/{id}', [ProfileController::class, 'show'])->name('profile.show');
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});


// Feed routes
Route::group(['prefix' => 'feeds'], function () {
    Route::get('/', [FeedController::class, 'index'])->name('feeds.index');
    Route::get('/create', [FeedController::class, 'create'])->name('feeds.create');
    Route::post('/store', [FeedController::class, 'store'])->name('feeds.store');
    Route::get('/edit/{id}', [FeedController::class, 'edit'])->name('feeds.edit');
    Route::put('/update/{id}', [FeedController::class, 'update'])->name('feeds.update');
    Route::delete('/delete/{id}', [FeedController::class, 'destroy'])->name('feeds.destroy');
    Route::get('/show/{id}', [FeedController::class, 'show'])->name('feeds.show');
});

// Post routes
Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/show/{id}', [PostController::class, 'show'])->name('posts.show');
});

// Like routes
Route::group(['prefix' => 'likes'], function () {
    Route::post('/store', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/delete/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
});

// Comment routes
Route::group(['prefix' => 'comments'], function () {
    Route::post('/store/{commentableId}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});