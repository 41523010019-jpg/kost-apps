<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Auto generate slug on create & update
     */
    protected static function boot()
    {
        parent::boot();

        // Saat create
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });

        // Saat update
        static::updating(function ($category) {
            // Hanya update slug jika name berubah
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
    public function pricePackages()
    {
        return $this->hasMany(PricePackage::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
