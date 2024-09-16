<?php

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
Route::get('/users',[UserController::class,'users'])->name('users');
Route::get('/edit/profile',[UserController::class,'edit_profile'])->name('edit.profile');
Route::post('/update/profile',[UserController::class,'update_profile'])->name('update.profile');
Route::post('/update/password',[UserController::class,'update_password'])->name('update.password');
Route::post('/update/photo',[UserController::class,'update_photo'])->name('update.photo');
 