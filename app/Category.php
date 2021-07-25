<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use SoftDeletes;

    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    public function parents() {
        return $this->belongsToMany(User::class, 'category_relations', 'category_id', 'parent_category_id');
    }
}
