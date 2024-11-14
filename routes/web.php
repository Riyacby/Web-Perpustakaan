<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminUserController;

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

Route::resource('books', BookController::class);
Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/do', [AdminAuthController::class, 'dologin'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::get('/',function(){
    $data = [
        'content'   =>'admin.dashboard.index'
    ];
    return view('admin.layouts.wrapper', $data);
});

Route::get('/dashboard', function(){
    $data = [
        'content'   => 'admin.dashboard.index'
    ];
    return view('admin.layouts.wrapper', $data);
});

Route::get('/user', function(){
    $data = [
        'content'   => 'admin.user.index'
    ];
    return view('admin.layouts.wrapper', $data);
});

Route::get('/post', function () {
    $data =[
        'content' =>'admin.post.index'
    ];
    return view('admin.layouts.wrapper', $data);
});

