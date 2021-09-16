<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Route::get('/admin/category/subcategory/{category:slug}', [CategoryController::class, 'getsubcategory'])->name('admin.get.subcategory');

Route::get("/test", function(){
    return "okay";
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
