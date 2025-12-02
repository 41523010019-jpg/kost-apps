<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'is_available',
        'description',
    ];

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
