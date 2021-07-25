<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model {
    use SoftDeletes;

    protected $guarded = ['id', 'deleted_at', 'created_at', 'updated_at'];

    public static $APARTMENT_HTTP_PARAMS_DB_COLUMNS_MAP = [
        'id' => ['column' => 'id', 'operation' => null],
        'name' => ['column' => 'name', 'operation' => 'like'],
        'slug' => ['column' => 'slug', 'operation' => null],
        'price' => ['column' => 'price', 'operation' => 'arithmeticFloat'],
        'description' => ['column' => 'description', 'operation' => 'like'],
        'rating' => ['column' => 'rating', 'operation' => 'arithmeticFloat'],
        'created_at' => ['column' => 'created_at', 'operation' => 'date'],
        'category_id' => ['column' => 'category_id', 'operation' => null],
        'size' => ['column' => 'properties->size', 'operation' => 'arithmeticInteger'],
        'location' => ['column' => 'properties->location', 'operation' => 'like'],
        'numberOfBalconies' => ['column' => 'properties->numberOfBalconies', 'operation' => 'arithmeticInteger'],
        'balconySize' => ['column' => 'properties->balconySize', 'operation' => 'arithmeticInteger'],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
