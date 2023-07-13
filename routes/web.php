<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

// ======= _______ Create account and login account View Route ________ ============

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'registerView')->name('register');
    Route::get('/', 'loginView')->name('login');
    Route::get('/allpost', 'PostListView')->name('post_list');    
});

