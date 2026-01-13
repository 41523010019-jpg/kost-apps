<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'address',
        'address_note',
        'phone',
        'phone_note',
        'email',
        'map_embed',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /* =========================
     * Scope
     * ========================= */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
