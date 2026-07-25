<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\GiveawayController;

//['register' => false]
Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog');
Route::get('/blog/{post}', [App\Http\Controllers\PostController::class, 'getPost'])->name('posts.show');
Route::get('/new', [App\Http\Controllers\PostController::class, 'getLatestPost'])->name('latest-post');


Route::get('/resources', [App\Http\Controllers\ResourcesController::class, 'index'])->name('resources');
Route::get('/resource/wallpaper', [App\Http\Controllers\ResourcesController::class, 'wallpaperIndex'])->name('resource');
Route::get('/resource/my-mind', [ImageGalleryController::class, 'index'])->name('my-mind');
Route::get('/my-mind', [ImageGalleryController::class, 'index'])->name('my-mind');

Route::post('/upload', [ImageGalleryController::class, 'upload'])->name('upload');
Route::delete('/delete-image/{id}', [ImageGalleryController::class, 'destroy'])->name('image.destroy');


//Admin

Route::get('/admin/posts', [AdminPostController::class, 'adminPostIndex'])->name('admin.posts.index');

//Surveys


Route::get('/survey', [SurveyController::class, 'show'])
     ->name('survey');

Route::post('/survey', [SurveyController::class, 'submit'])
     ->name('survey.submit');

Route::get('/giveaway', [GiveawayController::class, 'show'])
    ->name('giveaway.show');
Route::get('/giveaway/icon', [GiveawayController::class, 'icon'])
    ->name('giveaway.icon');
Route::post('/giveaway', [GiveawayController::class, 'submit'])
    ->middleware('throttle:5,1')
    ->name('giveaway.submit');

Route::middleware('auth')->group(function () {
    Route::get('/create-post', [AdminPostController::class, 'createIndex'])->name('create-post');
    Route::post('/store', [AdminPostController::class, 'store'])->name('store');
    Route::get('/edit-post/{post}', [AdminPostController::class, 'editIndex'])->name('edit-post');
    Route::put('/edit-post/{post}', [AdminPostController::class, 'editPost'])->name('posts.update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'deletePost'])->name('delete-post');
    Route::get('/admin/giveaway', [GiveawayController::class, 'index'])
        ->name('admin.giveaway.index');
    Route::get('/admin/giveaway/settings', [GiveawayController::class, 'edit'])
        ->name('admin.giveaway.edit');
    Route::put('/admin/giveaway/settings', [GiveawayController::class, 'update'])
        ->name('admin.giveaway.update');
    Route::post('/admin/giveaway/close', [GiveawayController::class, 'close'])
        ->name('admin.giveaway.close');
    Route::post('/admin/giveaway/new', [GiveawayController::class, 'startNew'])
        ->name('admin.giveaway.new');
    Route::get('/admin/giveaway/{entry}/proof', [GiveawayController::class, 'proof'])
        ->name('admin.giveaway.proof');
});
