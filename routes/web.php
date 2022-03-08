<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Validation\ValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Category;

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

Route::post('newsletter', NewsletterController::class);

Route::get('/',[PostController::class,'index'])->name("home");

Route::get('posts/{post:slug}',[PostController::class,'show']);

Route::middleware('can:admin')->group(function (){

    Route::get('admin/posts/create',[AdminPostController::class,'create']);
    Route::get('admin/posts',[AdminPostController::class,'index']);
    Route::get('admin/posts/{post:id}/edit',[AdminPostController::class,'edit']);
    Route::patch('admin/posts/{post:id}',[AdminPostController::class,'update']);
    Route::delete('admin/posts/{post:id}',[AdminPostController::class,'destroy']);
    Route::post('admin/posts',[AdminPostController::class,'store']);
});


Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');
Route::get('login',[SessionsController::class,'create'])->middleware('guest');
Route::post('login',[SessionsController::class,'store'])->middleware('guest');
Route::post('logout',[SessionsController::class,'destroy'])->middleware('auth');
Route::post('posts/{post:slug}/comments',[CommentController::class,'store'])->middleware('auth');


//Route::get('category/{category:slug}',function (Category $category){
//    return view("posts",[
//        'categories' => Category::all(),
//        'currentCategory' => $category,
//        'posts' => $category->posts
//    ]);
//});

//Route::get('author/{author:username}',function (User $author){
//    return view("posts.index",[
//        'posts' => $author->posts
//    ]);
//});
