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
    #roles
    Route::group(['prefix'=>'roles', 'as'=>'roles.'],function () {
        Route::get('/index', 'RolesController@index')->name('index');
        Route::post('/store', 'RolesController@store')->name('store');
        Route::get('/show/{role}', 'RolesController@show')->name('show');
        Route::put('/update/{role}', 'RolesController@update')->name('update');
        Route::delete('/delete/{role}', 'RolesController@destroy')->name('delete');
    });
});
