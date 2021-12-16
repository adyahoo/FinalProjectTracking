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

Route::get('/dashboard', function () {
    return view('project.admin.pages.dashboard.dashboard');
})->middleware(['admin'])->name('dashboard');

Route::group(['prefix'=>'membership'], function () {
    #Roles
    Route::group(['prefix'=>'roles', 'as'=>'roles.'],function () {
        Route::get('/index', 'RolesController@index')->name('index');
        Route::post('/store', 'RolesController@store')->name('store');
        Route::get('/show/{role}', 'RolesController@show')->name('show');
        Route::put('/update/{role}', 'RolesController@update')->name('update');
        Route::delete('/delete/{role}', 'RolesController@destroy')->name('delete');
    });

    #Divisions
    Route::group(['prefix'=>'divisions', 'as'=>'divisions.'],function () {
        Route::get('/index', 'DivisionsController@index')->name('index');
        Route::post('/store', 'DivisionsController@store')->name('store');
        Route::get('/show/{division}', 'DivisionsController@show')->name('show');
        Route::put('/update/{division}', 'DivisionsController@update')->name('update');
        Route::delete('/delete/{division}', 'DivisionsController@destroy')->name('delete');
    });

    #Members
    Route::group(['prefix'=>'members', 'as'=>'members.'],function () {
        Route::get('/index', 'MemberController@index')->name('index');
        Route::post('/store', 'MemberController@store')->name('store');
        Route::get('/show/{member}', 'MemberController@show')->name('show');
        Route::put('/update/{member}', 'MemberController@update')->name('update');
        Route::delete('/delete/{member}', 'MemberController@destroy')->name('delete');
    });
});

Route::group(['prefix'=>'projects'], function () {

    #Modules
    Route::group(['prefix'=>'modules', 'as'=>'modules.'],function () {
        Route::get('/index', 'ModulesController@index')->name('index');
        Route::post('/store', 'ModulesController@store')->name('store');
        Route::get('/show/{module}', 'ModulesController@show')->name('show');
        Route::put('/update/{module}', 'ModulesController@update')->name('update');
        Route::delete('/delete/{module}', 'ModulesController@destroy')->name('delete');
    });


});

Route::group(['prefix'=>'blogs'], function () {
    #Categories
    Route::group(['prefix'=>'blog_categories', 'as'=>'blog_categories.'],function () {
        Route::get('/index', 'BlogCategoriesController@index')->name('index');
        Route::post('/store', 'BlogCategoriesController@store')->name('store');
        Route::get('/show/{category}', 'BlogCategoriesController@show')->name('show');
        Route::put('/update/{category}', 'BlogCategoriesController@update')->name('update');
        Route::delete('/delete/{category}', 'BlogCategoriesController@destroy')->name('delete');
    });
    Route::group(['prefix'=>'admin_blog','as'=>'blog.'],function () {
        Route::get('/index', 'BlogController@index')->name('index');
        Route::get('/create', 'BlogController@create')->name('create');
        Route::post('/store','BlogController@store')->name('store');
        Route::get('/preview/{slug}', 'BlogController@show')->name('preview');
        Route::get('/edit/{blog}', 'BlogController@edit')->name('edit');
        Route::put('/update/{blog}', 'BlogController@update')->name('update');
        Route::delete('/delete/{blog}', 'BlogController@destroy')->name('delete');
    });
});
