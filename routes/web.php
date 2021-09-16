<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\aAuth\AuthController;
use App\Http\Controllers\aAuth\LoginController;
use App\Http\Controllers\aAuth\SocialAuthController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\StripeController;

//route to home
Route::get('/', [HomeController::class, 'index'])->name('home');

//register page route
Route::get('/signup', [AuthController::class, 'index'])->name('signup');
Route::post('/signup/action', [AuthController::class, 'signup'])->name('mksignup');


//login page route
Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login/action', [LoginController::class, 'login'])->name('login.action');

//logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(['auth']);

Route::get('/login/google/request', [SocialAuthController::class, 'googleRequest'])->name('google.login_request');
Route::get('/login/google/response', [SocialAuthController::class, 'googleResponse'])->name('google.login_response');


//terms route
Route::get('/terms', [ExtraController::class, 'termsAndConditions'])->name('terms');


//admin routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
Route::get('/admin/addpost', [PostController::class, 'post'])->name('admin.post');
Route::post('/admin/addpost', [PostController::class, 'storepost']);
Route::put('/admin/edit/{post:slug}', [PostController::class, 'editpost'])->name('admin.post.edit');

// Route::get('/admin/category/subcategory/{category:slug}', [CategoryController::class, 'getsubcategory'])->name('admin.get.subcategory');

Route::get('/admin/allposts', [PostController::class, 'showposts'])->name('admin.allposts');

Route::delete('/admin/posts/delete', [PostController::class, 'destroyposts'])->name('admin.posts.delete');

Route::get('/admin/categories', [CategoryController::class, 'category'])->name('admin.category');
Route::post('/admin/categories', [CategoryController::class, 'storecategory']);

Route::post('/admin/categories/{maincategory:slug}', [CategoryController::class, 'storesubcategory'])->name('admin.addsub');



Route::get('/post/{post:slug}', [HomeController::class, 'showsinglepost'])->name('single.post');


//post edit route

Route::get('/admin/post/edit/{post:slug}', [PostController::class, 'showSinglePostToEdit'])->name('single.post.edit');


//postlike route

Route::post('/post/like/{post}', [HomeController::class, 'likethepost'])->name('post.like');


//post comments

Route::post('/post/comment/{post}', [HomeController::class, 'postcomments'])->name('post.comment');

Route::put('/post/comment/edit/{comment}', [HomeController::class, 'editcomment'])->name('edit.comment');

Route::delete('/post/comment/delete/{comment}', [HomeController::class, 'deletecomment'])->name('delete.comment');

Route::get('/post/comment/load/{post}/{limit}', [HomeController::class, 'loadcomment'])->name('load.comment');


Route::get('/post/read/quick/{post}', [HomeController::class, 'quickread'])->name('post.quick.read');



//comment like

Route::post('/post/comment/like/{comment}', [HomeController::class, 'likethecomment'])->name('post.comment.like');



Route::get('/category/{category:slug}', [HomeController::class, 'collection'])->name('post.collection');


Route::get('/post/categories/get/{post}', [HomeController::class, 'postcategories'])->name('post.get.categories');





//stripe payment routes

Route::get('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.post');
Route::post('/stripe/checkout', [StripeController::class, 'afterpayment']);


Route::get('/stripe/s/checkout', [StripeController::class, 'checkoutsec'])->name('stripe.post.sec');
Route::post('/stripe/s/checkout', [StripeController::class, 'checkoutsecpayment']);