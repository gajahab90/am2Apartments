<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model {
    use SoftDeletes;

    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
