<?php

namespace App\Observers;

use App\Apartment;
use Illuminate\Support\Str;

class ApartmentObserver
{
    /**
     * Handle the apartment "saving" event.
     *
     * @param \App\Apartment $apartment
     * @return void
     * @throws \Exception
     */
    public function saving(Apartment $apartment) {
        if($apartment->isDirty('name')) {
            $apartment->slug = Str::slug($apartment->name . " " . mt_rand(0, 10000), '_');
        }

        if($apartment->isDirty(['price', 'currency'])) {
            if(isset($apartment->currency) && strtoupper($apartment->currency) != env('DEFAULT_CURRENCY', 'EUR')) {
                $convertedToDefaultCurrency = convert_currency($apartment->price, $apartment->currency, env('DEFAULT_CURRENCY', 'EUR'));
                if($convertedToDefaultCurrency) {
                    $apartment->price = $convertedToDefaultCurrency;
                    $apartment->currency = env('DEFAULT_CURRENCY', 'EUR');
                }
            }
        }
    }

    /**
     * Handle the apartment "created" event.
     *
     * @param  \App\Apartment  $apartment
     * @return void
     */
    public function created(Apartment $apartment)
    {
        //
    }

    /**
     * Handle the apartment "updated" event.
     *
     * @param  \App\Apartment  $apartment
     * @return void
     */
    public function updated(Apartment $apartment)
    {
        //
    }

    /**
     * Handle the apartment "deleted" event.
     *
     * @param  \App\Apartment  $apartment
     * @return void
     */
    public function deleted(Apartment $apartment)
    {
        //
    }

    /**
     * Handle the apartment "restored" event.
     *
     * @param  \App\Apartment  $apartment
     * @return void
     */
    public function restored(Apartment $apartment)
    {
        //
    }

    /**
     * Handle the apartment "force deleted" event.
     *
     * @param  \App\Apartment  $apartment
     * @return void
     */
    public function forceDeleted(Apartment $apartment)
    {
        //
    }
}
