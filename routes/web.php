<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassResetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\search;

//Frontend 
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/author/login/page',[FrontendController::class,'author_login_page'])->name('author.login.page');
Route::get('/author/register/page',[FrontendController::class,'author_register_page'])->name('author.register.page');

Route::get('/dashboard',[HomeController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

//Backend  
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Profile 
Route::post('/add/user',[UserController::class,'add_user'])->middleware('auth')->name('add.user');
Route::get('/users',[UserController::class,'users'])->name('users');
Route::get('/edit/profile',[UserController::class,'edit_profile'])->middleware('auth')->name('edit.profile');
Route::post('/update/profile',[UserController::class,'update_profile'])->name('update.profile');
Route::post('/update/password',[UserController::class,'update_password'])->name('update.password');
Route::post('/update/photo',[UserController::class,'update_photo'])->name('update.photo');
Route::get('/user/delete/{user_id}',[UserController::class,'user_delete'])->middleware('auth')->name('user.delete');
 


//category 
Route::get('/category',[CategoryController::class,'category'])->middleware('auth')->name('category');
Route::post('/category/store',[CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/edit/{category_id}',[CategoryController::class,'category_edit'])->middleware('auth')->name('category.edit');
Route::post('/category/update/{category_id}',[CategoryController::class,'category_update'])->name('category.update');
Route::get('/category/delete/{category_id}',[CategoryController::class,'category_delete'])->name('category.delete');

//tash delete 
Route::get('/trash',[CategoryController::class,'trash'])->middleware('auth')->name('trash');
Route::get('/category/restore/{category_id}',[CategoryController::class,'category_restore'])->name('category.restore');
Route::get('/category/hard/delete/{category_id}',[CategoryController::class,'category_hard_delete'])->name('category.hard.delete');
Route::post('/category/check_delete',[CategoryController::class,'category_ckeck_delete'])->name('category.check.delete');
Route::post('/category/check_restore',[CategoryController::class,'category_ckeck_restore'])->name('category.check.restore');

//Tag controller 
Route::get('/tags',[TagController::class,'tags'])->middleware('auth')->name('tags');
Route::post('/tag/store',[TagController::class,'tag_store'])->name('tag.store');
Route::get('/tag/delete/{tag_id}',[TagController::class,'tag_delete'])->middleware('auth')->name('tag.delete');

//author controller 
route::post('/author/register/post',[AuthorController::class,'author_register'])->name('author.register');
route::post('/author/login/post',[AuthorController::class,'author_login'])->name('author.login');
route::get('/author/logout',[AuthorController::class,'author_logout'])->name('author.logout');
route::get('/author/dashboard',[AuthorController::class,'author_dashboard'])->middleware('author')->name('author.dashboard');
Route::get('/authors',[UserController::class,'authors'])->name('authors');
Route::get('/authors/status/{author_id}',[UserController::class,'authors_status'])->name('authors.status');
Route::get('/authors/delete/{author_id}',[UserController::class,'authors_delete'])->name('authors.delete');

route::get('/author/edit',[AuthorController::class,'author_edit'])->name('author.edit');
route::post('/author/profile/update',[AuthorController::class,'author_profile_update'])->name('author.profile.update');
route::post('/author/pass/update',[AuthorController::class,'author_pass_update'])->name('author.pass.update');
route::get('/author/verify/{token}',[AuthorController::class,'author_verify'])->name('author.verify');
route::get('/request/verify',[AuthorController::class,'request_verify'])->name('request.verify');
route::post('/request/verify/send',[AuthorController::class,'request_verify_send'])->name('request.verify.send');

//Post controller
route::get('/add/post',[PostController::class,'add_post'])->name('add.post');
route::post('/post/store',[PostController::class,'post_store'])->name('post.store');
route::get('/my/post',[PostController::class,'my_post'])->name('my.post');
route::get('/my/post/status/{post_id}',[PostController::class,'my_post_status'])->name('my.post.status');
route::get('/my/post/delete/{post_id}',[PostController::class,'my_post_delete'])->name('my.post.delete');
route::get('/post/details/{slug}',[FrontendController::class,'post_details'])->name('post.details');
route::get('/author/post/{author_id}',[FrontendController::class,'author_post'])->name('author.post');
route::get('/category/post/{category_id}',[FrontendController::class,'category_post'])->name('category.post');


//search
route::get('/search',[FrontendController::class,'search'])->name('search');
route::get('/tag_post/{tag_id}',[FrontendController::class,'tag_post'])->name('tag.post');

//comments section 
route::post('/comment/store',[FrontendController::class,'comment_store'])->name('comment.store');


//Role 
//role management using laravel packages => spatli permission laravel 
route::get('/role',[RoleController::class,'role'])->name('role');
route::post('/permission/store',[RoleController::class,'permission_store'])->name('permission.store');
route::post('/role/store',[RoleController::class,'role_store'])->name('role.store');
route::post('/role/assign',[RoleController::class,'role_assign'])->name('role.assign');
route::get('/role/delete/{role_id}',[RoleController::class,'role_delete'])->name('role.delete');
route::get('/role/remove/{user_id}',[RoleController::class,'role_remove'])->name('role.remove');

//password reset /forgot password section
route::get('/pass/reset/req',[PassResetController::class, 'pass_reset_req'])->name('pass.reset.req');
route::post('/pass/reset/req/send',[PassResetController::class, 'pass_reset_req_send'])->name('pass.reset.req.send');
route::get('/pass/reset/form/{token}',[PassResetController::class, 'pass_reset_form'])->name('pass.reset.form');
route::post('/pass/reset/update/{token}',[PassResetController::class, 'pass_reset_update'])->name('pass.reset.update');