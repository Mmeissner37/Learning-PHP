<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get(); 
    }
    return view('home', ['posts' => $posts]);
}); 

Route::post('/register', [UserController::class, 'register']);  //Import class
Route::post('/logout', [UserController::class, 'logout']);  //Must create public function in controller to determine function 
Route::post('/login', [UserController::class, 'login']);


//Blog post related routes 
Route::post('/create-post', [PostController::class, 'createPost']); //Import class
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']); //This will update a post, must create function in PostController
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']); //This will delete a post, must create function in PostController


