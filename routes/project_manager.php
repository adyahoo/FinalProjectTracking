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
    return view('project.project_manager.pages.dashboard.dashboard');
})->middleware(['project_manager'])->name('dashboard');

Route::group([
    'as'     => 'projects.',
    'prefix' => 'projects',
], function () {

    Route::get('/', 'ProjectController@index')
                    ->name('all');
    Route::get('/create', 'ProjectController@create')
                    ->name('create');
    Route::post('/store', 'ProjectController@store')
                    ->name('store');
    Route::get('/edit/{project}', 'ProjectController@edit')
                    ->name('edit');
    Route::post('/update/{project}', 'ProjectController@update')
                    ->name('update');
    Route::delete('/destroy/{project}', 'ProjectController@destroy')
                    ->name('destroy');

});
