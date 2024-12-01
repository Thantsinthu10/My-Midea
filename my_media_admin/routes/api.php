<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

//post
Route::get('allPost',[PostController::class,'getAllPost']);
Route::post('search/post',[PostController::class,'searchPost']);
Route::post('post/details',[PostController::class,'postDetails']);


//category
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('search/category',[CategoryController::class,'searchCategory']);

//action log
Route::post('post/actionLog',[ActionLogController::class,'setActionLog']);
