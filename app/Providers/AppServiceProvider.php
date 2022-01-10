<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\BlogCategories;
use App\Models\Blog;
use App\Models\PageSetting;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $categories = BlogCategories::all();
            $blogYears  = Blog::selectRaw('YEAR(published_at) as year')->distinct()->orderBy('year')->get();
            $blogMonths = Blog::selectRaw('MONTH(published_at) as month')->distinct()->orderBy('month')->get();            
            $view->with('categories', $categories)
                ->with('blogYears', $blogYears)
                ->with('blogMonths', $blogMonths);
        });

        view()->share('page', PageSetting::first());
    }
}
