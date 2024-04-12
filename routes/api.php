<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);


Route::get('category',[AuthController::class,'category'])->middleware('auth:sanctum');



Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('post/search',[PostController::class,'search']);
Route::post('post/detail',[PostController::class,'details']);



Route::get('allCategoryList',[CategoryController::class,'getAllCategory']);
Route::post('searchCategory',[CategoryController::class,'search']);


Route::post('post/action/log',[ActionLogController::class,'setActionLog']);
//
