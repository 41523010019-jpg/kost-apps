<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricePackage extends Model
{
    protected $fillable = [
        'category_id',
        'price_per_month',
        'facilities',
        'is_popular',
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_popular' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
