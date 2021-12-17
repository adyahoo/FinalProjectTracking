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
    Route::put('/update/{project}', 'ProjectController@update')
                    ->name('update');
    Route::delete('/destroy/{project}', 'ProjectController@destroy')
                    ->name('destroy');
    Route::get('/{project}', 'ProjectController@detail')
                    ->name('detail');
    Route::get('/{project}/scope', 'ProjectController@scope')
                    ->name('scope');
    Route::get('/{project}/credentials', 'ProjectController@credentials')
                    ->name('credentials');
    Route::put('/launch_date/{project}', 'ProjectController@addLaunchDate')
                    ->name('addLaunchDate');

    Route::group([
        'as'     => 'version.',
        'prefix' => 'version',
    ], function () {
        Route::get('/{project}', 'ProjectVersionController@index')
                    ->name('all');
        Route::get('/{project}/detail/{version}', 'ProjectVersionController@detail')
                    ->name('detail');
    });

    Route::group([
        'as'     => 'module.',
        'prefix' => 'module',
    ], function () {
        Route::get('/{project}', 'ProjectDetailController@index')
                    ->name('all');
        Route::post('/{project}/store', 'ProjectDetailController@store')
                    ->name('store');
        Route::get('/edit/{project_detail}', 'ProjectDetailController@edit')
                    ->name('edit');
        Route::put('/update/{project_detail}', 'ProjectDetailController@update')
                    ->name('update');
        Route::delete('/destroy/{project_detail}', 'ProjectDetailController@destroy')
                    ->name('destroy');
        Route::get('/show/{project_detail}', 'ProjectDetailController@show')
                    ->name('show');

        Route::group([
            'as'     => 'special.',
            'prefix' => 'special',
        ], function () {
            Route::post('/{project}/store', 'ProjectDetailController@storeSpecial')
                        ->name('store');
            Route::put('/update/{project_detail}', 'ProjectDetailController@updateSpecial')
                        ->name('update');
            Route::delete('/destroy/{project_detail}', 'ProjectDetailController@destroySpecial')
                        ->name('destroy');
        });

        Route::group([
            'as'     => 'member.',
            'prefix' => 'member',
        ], function () {
            Route::post('/{project_detail}/store', 'UserAssignmentController@store')
                        ->name('store');
            Route::delete('/destroy/{user_assignment}', 'UserAssignmentController@destroy')
                        ->name('destroy');
        });
    });

});
