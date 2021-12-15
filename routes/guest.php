<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('blog.dashboard');
});

Route::get('/blog', function () {
    return view('blog.blog');
})->name("blog");

Route::get('/blog_detail', function () {
    return view('blog.detail_blog');
})->name("detail_blog");

Route::get('/author', function () {
    return view('blog.author');
})->name("author");

require __DIR__.'/auth.php';