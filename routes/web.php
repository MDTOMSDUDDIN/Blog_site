<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Frontend 
Route::get('/',[FrontendController::class,'welcome']);

Route::get('/dashboard',[HomeController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

//Backend  
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Profile 
Route::post('/add/user',[UserController::class,'add_user'])->name('add.user');
Route::get('/users',[UserController::class,'users'])->name('users');
Route::get('/edit/profile',[UserController::class,'edit_profile'])->name('edit.profile');
Route::post('/update/profile',[UserController::class,'update_profile'])->name('update.profile');
Route::post('/update/password',[UserController::class,'update_password'])->name('update.password');
Route::post('/update/photo',[UserController::class,'update_photo'])->name('update.photo');
Route::get('/user/delete/{user_id}',[UserController::class,'user_delete'])->name('user.delete');
 


//category 
Route::get('/category',[CategoryController::class,'category'])->name('category');
Route::post('/category/store',[CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/edit/{category_id}',[CategoryController::class,'category_edit'])->name('category.edit');
Route::post('/category/update/{category_id}',[CategoryController::class,'category_update'])->name('category.update');
Route::get('/category/delete/{category_id}',[CategoryController::class,'category_delete'])->name('category.delete');

//tash delete 
Route::get('/trash',[CategoryController::class,'trash'])->name('trash');
Route::get('/category/restore/{category_id}',[CategoryController::class,'category_restore'])->name('category.restore');
Route::get('/category/hard/delete/{category_id}',[CategoryController::class,'category_hard_delete'])->name('category.hard.delete');
Route::post('/category/check_delete',[CategoryController::class,'category_ckeck_delete'])->name('category.check.delete');
Route::post('/category/check_restore',[CategoryController::class,'category_ckeck_restore'])->name('category.check.restore');