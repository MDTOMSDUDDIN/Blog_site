<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PassRestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;

//Frontend
Route::get('/',[FrontendController::class,'index'])->name('index');
Route::get('/author/login/page',[FrontendController::class,'author_login_page'])->name('author.login.page');
Route::get('/author/register/page',[FrontendController::class,'author_register_page'])->name('author.register.page');

//Author list page
Route::get('/author/list',[FrontendController::class,'author_list'])->name('author.list');

//about list page
Route::get('/about',[FrontendController::class,'about'])->name('about');


//blog list show page
Route::get('/all/posts', [FrontendController::class, 'all_posts'])->name('all.posts');

//contact list show page

// Route for displaying the contact page
Route::get('/contact', function () {
    return view('frontend.author.contact');
})->name('contact');

// Route for handling the form submission
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');



// Route for displaying contact messages in the admin panel
Route::get('/admin/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact.messages');
Route::delete('/admin/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('admin.contact.messages.delete');











Route::get('/dashboard',[HomeController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';

//backend

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//profile administration
Route::post('add/user',[UserController::class,'add_user'])->middleware('auth')->name('add.user');
Route::get('/users',[UserController::class,'users'])->middleware('auth')->name('users');
Route::get('/edit/profile',[UserController::class,'edit_profile'])->middleware('auth')->name('edit.profile');
Route::post('/update/profile',[UserController::class,'update_profile'])->name('update.profile');
Route::post('/update/password',[UserController::class,'update_password'])->name('update.password');
Route::post('/update/photo',[UserController::class,'update_photo'])->name('update.photo');
Route::get('/user/delete/{user_id}',[UserController::class,'user_delete'])->name('user.delete');

//Category administration

Route::get('/category',[CategoryController::class,'category'])->middleware('auth')->name('category');
Route::get('/trash',[CategoryController::class,'trash'])->middleware('auth')->name('trash');
Route::post('/category/store',[CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/edit/{category_id}',[CategoryController::class,'category_edit'])->middleware('auth')->name('category.edit');
Route::post('/category/update/{category_id}',[CategoryController::class,'category_update'])->name('category.update');
Route::get('/category/delete/{category_id}',[CategoryController::class,'category_delete'])->name('category.delete');
Route::get('/category/restore/{category_id}',[CategoryController::class,'category_restore'])->name('category.restore');
Route::get('/category/hard/delete/{category_id}',[CategoryController::class,'category_hard_delete'])->name('category.hard.delete');
Route::post('/category/check_delete',[CategoryController::class,'category_check_delete'])->name('category.check.delete');
Route::post('/category/check/restore',[CategoryController::class,'category_check_restore'])->name('category.check.restore');

//tags administration
Route::get('/tags',[TagController::class,'tags'])->middleware('auth')->name('tags');
Route::post('/tags/store',[TagController::class,'tags_store'])->name('tags.store');
Route::get('/tags/delete/{tag_id}',[TagController::class,'tags_delete'])->name('tags.delete');


//Authors 
Route::post('/author/register/post',[AuthorController::class,'author_register'])->name('author.register');
Route::post('/author/login/post',[AuthorController::class,'author_login'])->name('author.login');
Route::get('/author/logout',[AuthorController::class,'author_logout'])->name('author.logout');
Route::get('/author/dashboard',[AuthorController::class,'author_dashboard'])->middleware('author')->name('author.dashboard');
Route::get('/authors/edit',[AuthorController::class,'author_edit'])->name('author.edit');
Route::post('/authors/profile/update',[AuthorController::class,'author_profile_update'])->name('author.profile.update');
Route::post('/authors/pass/update',[AuthorController::class,'author_pass_update'])->name('author.pass.update');

//Email Verification
Route::get('author/verify/{token}',[AuthorController::class,'author_verify'])->name('author.verify');

//request verification
Route::get('request/verify',[AuthorController::class,'request_verify'])->name('request.verify');
Route::post('request/verify/send',[AuthorController::class,'request_verify_send'])->name('request.verify.send');

//Password Reset Password
Route::get('pass/reset/req',[PassRestController::class,'pass_reset_req'])->name('pass.reset.req');

//Password Reset Request Password
Route::post('pass/reset/req/send',[PassRestController::class,'pass_reset_req_post'])->name('pass.reset.req.post');
//Password Reset From
Route::get('pass/reset/form/{token}',[PassRestController::class,'pass_reset_form'])->name('pass.reset.form');

Route::post('pass/reset/update/{token}',[PassRestController::class,'pass_reset_update'])->name('pass.reset.update');






//Authors Admin Controller
Route::get('/authors', [UserController::class, 'authors'])->middleware('auth')->name('authors');
Route::get('/author/delete/{author_id}',[UserController::class,'author_delete'])->name('author.delete');
Route::get('/authors/status/{author_id}', [UserController::class, 'authors_status'])->name('authors.status');


//posts authors 
Route::get('/add/post',[PostController::class,'add_post'])->name('add.post');
Route::post('/post/store',[PostController::class,'post_store'])->name('post.store');
Route::get('/my/post',[PostController::class,'my_post'])->name('my.post');
Route::get('/my/post/status/{post_id}',[PostController::class,'my_post_status'])->name('my.post.status');
Route::get('/my/post/delete/{post_id}',[PostController::class,'my_post_delete'])->name('my.post.delete');


//Frontend Controller post
Route::get('/my/post/details/{slug}',[FrontendController::class,'post_details'])->name('post.details');
Route::get('/author/post/{author_id}',[FrontendController::class,'author_post'])->name('author.post');
Route::get('/category/post/{category_id}',[FrontendController::class,'category_post'])->name('category.post');

//search
Route::get('/search',[FrontendController::class,'search'])->name('search');

//tags
Route::get('/tag/post/{tag_id}',[FrontendController::class,'tag_post'])->name('tag.post');


//subscriptions

Route::post('/subscribe', [SubscriptionsController::class, 'subscribe'])->name('subscriptions.subscribe');

// admin panel subscriptions show
Route::middleware('auth')->group(function () {
    Route::get('/admin/subscriptions', [SubscriptionsController::class, 'showSubscriptions'])->name('admin.subscriptions');
});

Route::get('/admin/subscriptions/delete/{id}', [SubscriptionsController::class, 'delete'])->name('subscriptions.delete');

//comments
Route::post('/comment/store', [FrontendController::class, 'comment_store'])->name('comment.store');



//Role
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission/store', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');

Route::post('/role/assign', [RoleController::class, 'role_assign'])->name('role.assign');

//role delete
Route::get('/role/delete/{role_id}', [RoleController::class, 'role_delete'])->name('role.delete');
Route::get('/role/remove/{user_id}', [RoleController::class, 'role_remove'])->name('role.remove');

//Resource controller

Route::resource('faq',FaqController::class);

