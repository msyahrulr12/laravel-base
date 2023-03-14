<?php

namespace App\Providers;

use App\Models\ContactUs;
use App\Models\SocialMedia;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('social_media', SocialMedia::all());
        View::share('contact_us', ContactUs::first());
        Paginator::useBootstrap();
    }
}
