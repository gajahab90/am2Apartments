<?php

namespace App\Observers;

use App\Rating;

class RatingObserver {
    /**
     * Handle the rating "saved" event.
     *
     * @param  \App\Rating  $rating
     * @return void
     */
    public function saved(Rating $rating) {
        $ratingChanged = $rating->isDirty('rating');

        if($ratingChanged) {
            $averageRating = Rating::where('apartment_id', $rating->apartment_id)->avg('rating');
            $apartment = $rating->apartment;
            $apartment->rating = $averageRating;
            $apartment->save();
        }
    }
}
