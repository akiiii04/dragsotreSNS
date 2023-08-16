<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('top');
})->middleware(['auth', 'verified'])->name('top');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){

    Route::get('/{type}/index', 'index')->name('index');
    Route::get('/{type}/create', 'create')->name('create');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/{post}/create', 'reply')->name('reply');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');

    
});

Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
    Route::post('/like/{post}', 'store')->name('like');
    Route::post('/unlike/{post}', 'destroy')->name('unlike');
});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    
    Route::get('/profile/{user}', 'show')->name('profile.show');
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile',  'destroy')->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
