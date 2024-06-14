<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog');
Route::get('/blog/{id?}', [App\Http\Controllers\PostController::class, 'getPost'])->name('blog');
Route::get('/resources', [App\Http\Controllers\ResourcesController::class, 'index'])->name('resources');
Route::get('/resource/wallpaper', [App\Http\Controllers\ResourcesController::class, 'wallpaperIndex'])->name('resource');
Route::get('/create-post', [App\Http\Controllers\AdminPostController::class, 'createIndex'])->name('create-post');
Route::get('/delete/{id?}', [App\Http\Controllers\AdminPostController::class, 'deletePost'])->name('delete-post');
Route::get('/edit-post/{id}', [App\Http\Controllers\AdminPostController::class, 'editIndex'])->name('edit-post');
Route::post('/edit-post/{id}', [App\Http\Controllers\AdminPostController::class, 'editPost'])->name('edit-post');
Route::match(array('POST'), '/store', [App\Http\Controllers\AdminPostController::class, 'store'])->name('store');


