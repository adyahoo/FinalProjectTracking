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
Route::get('/', 'HomeBlogController@index');
Route::get('/blog', 'ListBlogsController@index')->name("blog");
Route::post('/sort_blog', 'ListBlogsController@sort')->name("sort_blog");
Route::post('/author_sort_blog', 'AuthorController@sort')->name("author_sort_blog");
Route::post('/blog/search', 'ListBlogsController@returnSearch')->name("search");
Route::post('/blog/search/kategori', 'ListBlogsController@returnKategori')->name("kategori");
Route::post('/blog/search/filter', 'ListBlogsController@returnSidebar')->name("filter");
Route::get('/blog_detail/{slug}', 'DetailBlogController@index')->name("detail_blog");
Route::get('/author/{id}', 'AuthorController@index')->name("author");
Route::post('/like', 'HomeBlogController@likePost')->name("like");
Route::get('/like', 'HomeBlogController@getLikeCount')->name("like_count");

require __DIR__.'/auth.php';