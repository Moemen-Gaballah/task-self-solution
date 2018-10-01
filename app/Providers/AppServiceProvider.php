<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

//                     $categories = \App\Category::where('status', 1)->get();
//                     $Subcategories = \App\SubCategory::where('status', 1)->get();

//                     view()->share('categories', $categories);
//                     view()->share('Subcategories', $Subcategories);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
