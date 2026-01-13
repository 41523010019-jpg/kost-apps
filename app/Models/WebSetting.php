<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WebSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_title',
        'site_description',
        'social_media',
        'copyright',
        'is_active',
    ];

    protected $casts = [
        'social_media' => 'array', // JSON → array
        'is_active'    => 'boolean',
    ];

    /* =========================
     * Scope
     * ========================= */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
