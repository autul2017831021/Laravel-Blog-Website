<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\BlogPost;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogPost\BlogPostController;
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

Route::get('/',[HomeController::class,'index'])->name('home');

// Blog Related Routes
Route::get('/blog',[BlogPostController::class,'index'])->name('blog');
Route::get('/blog/create',[BlogPostController::class,'showCreateBlogForm'])->name('blog.create');
Route::post('/blog/create',[BlogPostController::class,'storeBlog']);
Route::get('/blog/{blogId}',[BlogPostController::class,'showBlogByID'])->name('blog.blogId');
Route::post('/blog/{blogPost}',function(BlogPost $blogPost){
    if(Gate::denies('deleteBlogByID',$blogPost)){
        //abort(403);
        return back()->with('unauthorized','You can not delete this post');
    }
    
    $id = $blogPost->id;
    $blog = BlogPost::findOrfail($id);
    $blog->delete();
    return redirect('/blog');

});

// Auth Related Routes
Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/register',[RegisterController::class,'showRegisterForm'])->name('register');
Route::post('/register',[RegisterController::class,'register']);


