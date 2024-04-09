<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);


Route::get('category',[AuthController::class,'category'])->middleware('auth:sanctum');
//
