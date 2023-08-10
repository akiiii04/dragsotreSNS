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

    Route::get('/trouble/index', 'trouble_index')->name('trouble_index');
    Route::get('/trouble/create', 'trouble_create')->name('trouble_create');
    Route::post('/trouble/posts', 'trouble_store')->name('trouble_store');
    Route::get('/trouble/posts/{post}', 'trouble_show')->name('trouble_show');
    Route::put('/trouble/posts/{post}', 'trouble_update')->name('trouble_update');
    Route::delete('/trouble/posts/{post}', 'trouble_delete')->name('trouble_delete');
    Route::get('/trouble/posts/{post}/edit', 'trouble_edit')->name('trouble_edit');
    
    Route::get('/info/index', 'info_index')->name('info_index');
    Route::get('/info/create', 'info_create')->name('info_create');
    Route::post('/info/posts', 'info_store')->name('info_store');
    Route::get('/info/posts/{post}', 'info_show')->name('info_show');
    Route::put('/info/posts/{post}', 'info_update')->name('info_update');
    Route::delete('/info/posts/{post}', 'info_delete')->name('info_delete');
    Route::get('/info/posts/{post}/edit', 'info_edit')->name('info_edit');
});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    
    Route::get('/profile/{user}', 'profile')->name('profile');
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile',  'destroy')->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
