<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{PostController};

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

Route::resource('posts', PostController::class);
// Route::get('posts', [PostController::class, 'index'])->name('posts');
// Route::get('post/{id}', [PostController::class, 'show'])->name('show_post');