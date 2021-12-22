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
Route::get('/', 'blog\HomeBlogController@index');
Route::get('/blog', 'blog\ListBlogsController@index')->name("blog");
Route::post('/sort_blog', 'blog\ListBlogsController@sort')->name("sort_blog");
Route::post('/blog/search', 'blog\ListBlogsController@returnSearch')->name("search");
Route::post('/blog/search/kategori', 'blog\ListBlogsController@returnKategori')->name("kategori");
Route::post('/blog/search/filter', 'blog\ListBlogsController@returnSidebar')->name("filter");
Route::get('/blog_detail/{slug}', 'blog\DetailBlogController@index')->name("detail_blog");
Route::get('/author/{id}', 'blog\AuthorController@index')->name("author");

require __DIR__.'/auth.php';