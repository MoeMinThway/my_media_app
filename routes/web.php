<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.profile.index');
    // })->name('dashboard');

    Route::get('/dashboard',[ProfileController::class,'index'])->name('dashboard');

    Route::prefix('admin')->group(function () {
        //admin update
        Route::post('updateAdmin',[ProfileController::class,'update'])->name('admin#update');
        //change PW
        Route::get('changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');
        Route::post('changePassword',[ProfileController::class,'changePasswordPost'])->name('admin#changePasswordPost');

        Route::get('list',[ListController::class,'list'])->name('admin#list');
        Route::get('delete/{id}',[ListController::class,'delete'])->name('admin#delete');
        Route::post('search',[ListController::class,'search'])->name('admin#search');


        Route::get('category',[CategoryController::class,'category'])->name('admin#category');
        Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('admin#category#delete');
        Route::get('category/editPage/{id}',[CategoryController::class,'editPage'])->name('admin#category#editPage');
        Route::post('category/editPage/',[CategoryController::class,'update'])->name('admin#category#update');
        Route::post('category/create',[CategoryController::class,'create'])->name('admin#category#create');
        Route::get('category/search',[CategoryController::class,'search'])->name('admin#category#search');


        Route::get('post',[PostController::class,'post'])->name('admin#post');
        Route::get('tpost',[TrendPostController::class,'tpost'])->name('admin#trendPost');

    });
});
