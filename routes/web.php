<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\SurveyController;

//['register' => false]
Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog');
Route::get('/blog/{id?}', [App\Http\Controllers\PostController::class, 'getPost'])->name('blog');
Route::get('/new', [App\Http\Controllers\PostController::class, 'getLatestPost'])->name('latest-post');


Route::get('/resources', [App\Http\Controllers\ResourcesController::class, 'index'])->name('resources');
Route::get('/resource/wallpaper', [App\Http\Controllers\ResourcesController::class, 'wallpaperIndex'])->name('resource');
Route::get('/resource/my-mind', [ImageGalleryController::class, 'index'])->name('my-mind');
Route::get('/my-mind', [ImageGalleryController::class, 'index'])->name('my-mind');

Route::get('/create-post', [App\Http\Controllers\AdminPostController::class, 'createIndex'])->name('create-post');
Route::get('/delete/{id?}', [App\Http\Controllers\AdminPostController::class, 'deletePost'])->name('delete-post');
Route::get('/edit-post/{id}', [App\Http\Controllers\AdminPostController::class, 'editIndex'])->name('edit-post');
Route::post('/edit-post/{id}', [App\Http\Controllers\AdminPostController::class, 'editPost'])->name('edit-post');
Route::match(array('POST'), '/store', [App\Http\Controllers\AdminPostController::class, 'store'])->name('store');

Route::post('/upload', [ImageGalleryController::class, 'upload'])->name('upload');
Route::delete('/delete-image/{id}', [ImageGalleryController::class, 'destroy'])->name('image.destroy');


//Admin

Route::get('/admin/posts', [AdminPostController::class, 'adminPostIndex'])->name('admin.posts.index');

//Surveys


Route::get('/survey', [SurveyController::class, 'show'])
     ->name('survey');

Route::post('/survey', [SurveyController::class, 'submit'])
     ->name('survey.submit');
