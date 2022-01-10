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

Route::get('/dashboard', 'DashboardController@index')->middleware(['employee'])->name('dashboard');

Route::group(['prefix' => 'profile','as'=>'profile.'], function () {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::put('/update/{user}', 'ProfileController@editProfile')->name('update');
    Route::get('/change-password', 'ProfileController@changePasswordPages')->name('change-password');
    Route::put('/change-password', 'ProfileController@changePassword')->name('change-password.submit');
});

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
    Route::get('/detail/{project}', 'ProjectController@detail')
                ->name('detail');
    Route::get('/detail/{project}/scope', 'ProjectController@scope')
                ->name('scope');
    Route::get('/detail/{project}/credentials', 'ProjectController@credentials')
                ->name('credentials');
    Route::put('/detail/launch_date/{project}', 'ProjectController@addLaunchDate')
                ->name('addLaunchDate');

    Route::group([
        'as'     => 'version.',
        'prefix' => 'version',
    ], function () {
        Route::get('/{project}', 'ProjectVersionController@index')
                    ->name('all');
        Route::get('/{project}/detail/{project_version}', 'ProjectVersionController@detail')
                    ->name('detail');
        Route::get('/{project}/create', 'ProjectVersionController@create')
                    ->name('create');
        Route::post('/{project}/store', 'ProjectVersionController@store')
                    ->name('store');
        Route::get('/edit/{project_version}', 'ProjectVersionController@edit')
                    ->name('edit');
        Route::put('/update/{project_version}', 'ProjectVersionController@update')
                    ->name('update');
        Route::delete('/destroy/{project_version}', 'ProjectVersionController@destroy')
                    ->name('destroy');
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
    });

    Route::group([
        'as'     => 'logs.',
        'prefix' => 'logs'
    ], function () {
        Route::get('/{project}', 'ProjectLogController@index')
                    ->name('all');
    });

    Route::group([
        'as'     => 'gantt_chart.',
        'prefix' => 'gantt_chart'
    ], function () {
        Route::get('/{project}/{version}', 'GanttChartController@retriveData')
                    ->name('index');
    });
});

Route::group([
    'as'     => 'blogs.',
    'prefix' => 'blogs'
], function () {
    Route::get('/', 'BlogController@index')
                ->name('all');
    Route::get('/create', 'BlogController@create')
                ->name('create');
    Route::post('/store', 'BlogController@store')
                ->name('store');
    Route::get('/edit/{blog}', 'BlogController@edit')
                ->name('edit');
    Route::put('/update/{blog}', 'BlogController@update')
                ->name('update');
    Route::delete('/destroy/{blog}', 'BlogController@destroy')
                ->name('destroy');
    Route::get('/preview/{slug}', 'BlogController@show')
                ->name('preview');
    Route::get('/review/{blog}', 'BlogReviewController@show')
                ->name('review');
});