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

#Dashboard
Route::get('/dashboard', 'DashboardController@index')->middleware(['admin'])->name('dashboard');

#Admin Profile
Route::group(['prefix' => 'profile', 'as'=>'profile.'], function () {
    Route::get('/', 'ProfileController@index')->name('profile');
    Route::put('/update/{user}', 'ProfileController@editProfile')->name('update');
    Route::get('/change-password', 'ProfileController@changePasswordPages')->name('change-password');
    Route::put('/change-password', 'ProfileController@changePassword')->name('change-password.submit');
});

Route::group(['prefix'=>'membership'], function () {
    #Master Roles
    Route::group(['prefix'=>'roles', 'as'=>'roles.'],function () {
        Route::get('/index', 'RolesController@index')->name('index');
        Route::post('/store', 'RolesController@store')->name('store');
        Route::get('/show/{role}', 'RolesController@show')->name('show');
        Route::put('/update/{role}', 'RolesController@update')->name('update');
        Route::delete('/delete/{role}', 'RolesController@destroy')->name('delete');
    });

    #Master Divisions
    Route::group(['prefix'=>'divisions', 'as'=>'divisions.'],function () {
        Route::get('/index', 'DivisionsController@index')->name('index');
        Route::post('/store', 'DivisionsController@store')->name('store');
        Route::get('/show/{division}', 'DivisionsController@show')->name('show');
        Route::put('/update/{division}', 'DivisionsController@update')->name('update');
        Route::delete('/delete/{division}', 'DivisionsController@destroy')->name('delete');
    });

    #Master Members
    Route::group(['prefix'=>'members', 'as'=>'members.'],function () {
        Route::get('/index', 'MemberController@index')->name('index');
        Route::post('/store', 'MemberController@store')->name('store');
        Route::get('/show/{member}', 'MemberController@show')->name('show');
        Route::put('/update/{member}', 'MemberController@update')->name('update');
        Route::delete('/delete/{member}', 'MemberController@destroy')->name('delete');
    });
});

Route::group(['prefix'=>'projects'], function () {
    #Master Modules
    Route::group(['prefix'=>'modules', 'as'=>'modules.'],function () {
        Route::get('/index', 'ModulesController@index')->name('index');
        Route::post('/store', 'ModulesController@store')->name('store');
        Route::get('/show/{module}', 'ModulesController@show')->name('show');
        Route::put('/update/{module}', 'ModulesController@update')->name('update');
        Route::delete('/delete/{module}', 'ModulesController@destroy')->name('delete');
    });

    Route::group(['prefix'=>'admin_projects', 'as'=>'admin_projects.'],function () {
        #Projects
        Route::get('/index', 'ProjectController@index')->name('index');
        Route::get('/create', 'ProjectController@create')->name('create');
        Route::post('/store', 'ProjectController@store')->name('store');
        Route::get('/edit/{project}', 'ProjectController@edit')->name('edit');
        Route::put('/update/{project}', 'ProjectController@update')->name('update');
        Route::delete('/destroy/{project}', 'ProjectController@destroy')->name('destroy');
        Route::get('/detail/{project}', 'ProjectController@detail')->name('detail');
        Route::get('/detail/{project}/scope', 'ProjectController@scope')->name('scope');
        Route::get('/detail/{project}/credentials', 'ProjectController@credentials')->name('credentials');
        Route::put('/detail/launch_date/{project}', 'ProjectController@addLaunchDate')->name('addLaunchDate');

        #Projects Version
        Route::group(['as' => 'version.', 'prefix' => 'version'], function () {
            Route::get('/{project}', 'ProjectVersionController@index')->name('index');
            Route::get('/{project}/detail/{project_version}', 'ProjectVersionController@detail')->name('detail');
            Route::get('/{project}/create', 'ProjectVersionController@create')->name('create');
            Route::post('/{project}/store', 'ProjectVersionController@store')->name('store');
            Route::get('/edit/{project_version}', 'ProjectVersionController@edit')->name('edit');
            Route::put('/update/{project_version}', 'ProjectVersionController@update')->name('update');
            Route::delete('/destroy/{project_version}', 'ProjectVersionController@destroy')->name('destroy');
        });

        #Project Detail
        Route::group(['as' => 'project_module.', 'prefix' => 'project_module'], function () {
            Route::get('/{project}', 'ProjectDetailController@index')->name('index');
            Route::post('/{project}/store', 'ProjectDetailController@store')->name('store');
            Route::get('/edit/{project_detail}', 'ProjectDetailController@edit')->name('edit');
            Route::put('/update/{project_detail}', 'ProjectDetailController@update')->name('update');
            Route::delete('/destroy/{project_detail}', 'ProjectDetailController@destroy')->name('destroy');
            Route::get('/show/{project_detail}', 'ProjectDetailController@show')->name('show');

            Route::group(['as' => 'special.', 'prefix' => 'special'], function () {
                Route::post('/{project}/store', 'ProjectDetailController@storeSpecial')->name('store');
                Route::put('/update/{project_detail}', 'ProjectDetailController@updateSpecial')->name('update');
                Route::delete('/destroy/{project_detail}', 'ProjectDetailController@destroySpecial')->name('destroy');
            });

            Route::group(['as' => 'member.', 'prefix' => 'member'], function () {
                Route::post('/{project_detail}/store', 'UserAssignmentController@store')->name('store');
                Route::delete('/destroy/{user_assignment}', 'UserAssignmentController@destroy')->name('destroy');
            });
        });

        #Projects Log
        Route::group(['as' => 'project_logs.', 'prefix' => 'project_logs'], function () {
            Route::get('/{project}', 'ProjectLogController@index')->name('index');
        });

        #Gantt Chart
        Route::group(['as' => 'gantt_chart.', 'prefix' => 'gantt_chart'], function () {
            Route::get('/{project}/{version}', 'GanttChartController@retriveData')->name('index');
        });

    });
});

Route::group(['prefix'=>'blogs'], function () {
    #Master Categories
    Route::group(['prefix'=>'blog_categories', 'as'=>'blog_categories.'],function () {
        Route::get('/index', 'BlogCategoriesController@index')->name('index');
        Route::post('/store', 'BlogCategoriesController@store')->name('store');
        Route::get('/show/{category}', 'BlogCategoriesController@show')->name('show');
        Route::put('/update/{category}', 'BlogCategoriesController@update')->name('update');
        Route::delete('/delete/{category}', 'BlogCategoriesController@destroy')->name('delete');
    });

    #Admin Personal Blog
    Route::group(['prefix'=>'admin_blog','as'=>'blog.'],function () {
        Route::get('/index', 'BlogController@index')->name('index');
        Route::get('/create', 'BlogController@create')->name('create');
        Route::post('/store','BlogController@store')->name('store');
        Route::get('/preview/{slug}', 'BlogController@show')->name('preview');
        Route::get('/edit/{blog}', 'BlogController@edit')->name('edit');
        Route::put('/update/{blog}', 'BlogController@update')->name('update');
        Route::delete('/delete/{blog}', 'BlogController@destroy')->name('delete');
    });

    #Admin Approval
    Route::group(['prefix'=>'review','as'=>'review.'],function () {
        Route::get('/index', 'BlogReviewController@index')->name('index');
        Route::post('/store/{blog}','BlogReviewController@store')->name('review');
        Route::get('/detail/{review}', 'BlogReviewController@show')->name('show');
    });

});

#Setting
Route::group(['prefix'=>'pagesetting','as'=>'pagesetting.'],function () {
    Route::get('/', 'PageSettingController@index')->name('index');
    Route::post('/store','PageSettingController@store')->name('save');
});

#Logs
Route::group(['prefix'=>'logs', 'as'=>'logs.'], function () {
    Route::get('/index', 'LogController@index')->name('index');
    Route::get('/show/{log}', 'LogController@show')->name('show');
});
