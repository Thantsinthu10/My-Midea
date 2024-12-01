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
    'verified'
])->group(function () {
    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'directChangePassword'])->name('admin#directChangePassword');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');


    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#accountDelete');
    Route::post('admin/listSearch',[ListController::class,'adminListSearch'])->name('admin#listSearch');

    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin#deleteCategory');
    Route::post('category/search',[CategoryController::class,'categorySearch'])->name('admin#categorySearch');
    Route::get('category/editPage/{id}',[CategoryController::class,'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdatePage'])->name('admin#categoryUpdatePage');

     //post
     Route::get('post',[PostController::class,'index'])->name('admin#post');
     Route::post('admin/createPost',[PostController::class,'createPost'])->name('admin#createPost');
     Route::get('admin/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletePost');
     Route::get('admin/updatePostPage/{id}',[PostController::class,'updatePostPage'])->name('admin#updatePostPage');
     Route::post('admin/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#postUpdate');

      //trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'trendPostDetails'])->name('admin#trendPostDetails');

});

