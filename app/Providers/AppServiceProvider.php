<?php

namespace App\Providers;

use App\Apartment;
use App\Observers\ApartmentObserver;
use App\Observers\RatingObserver;
use App\Rating;
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
        Apartment::observe(ApartmentObserver::class);
        Rating::observe(RatingObserver::class);
    }
}
