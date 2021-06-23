<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
//use App\Http\Controllers\NotificacionesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', [PostController::Class, 'index']);
Route::get('/', function(){
    return redirect("/posts");
});
Route::get('/home', function(){
    return redirect('/posts');
});

Route::get('/posts', [PostController::Class, 'index']);

Route::get('/notificaciones', [CommentController::Class,'notificaciones']);

//Route::view('/posts/create', [PostController::Class, 'store']);
Route::view('/posts/create', 'posts.create');
Route::view('/editprofile', 'posts.editprofile');
Route::view('/reset', 'auth.passwords.reset');

//Route::get('/posts/create', [PostController::Class, 'store']);

Route::post('/posts/create', [PostController::Class, 'store']);
//Route::post('/posts', [PostController::Class, 'store']);
Route::get('/posts/myposts', [PostController::Class, 'userPosts']);
Route::get('/posts/{id}', [PostController::Class, 'show'])->name('post');
Route::post('/comments',[CommentController::class,'store']);
Route::post('/delete',[PostController::class,'deletePost']);
Route::post('/editaccount',[UserController::class,'editeProfile']);
Route::post('/changepassword',[UserController::class,'changePassword']);
Route::post('/deleteaccount',[UserController::class,'deleteAccount']);


Route::get('/today', [PostController::Class,'todaylist']);

//Route::view('/posts/create', 'create');
//Route::post('/posts/create', [PostController::Class, 'create']);

/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');
