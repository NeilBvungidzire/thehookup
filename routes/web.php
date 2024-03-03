<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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