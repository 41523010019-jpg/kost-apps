<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RoomPhoto extends Model
{
    protected $fillable = [
        'room_id',
        'path',
    ];

    // supaya attribute 'url' muncul saat model di-convert ke array/json
    protected $appends = ['url'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // accessor: full public url ke file (menggunakan Storage::url atau asset)
    public function getUrlAttribute()
    {
        // jika file disimpan di disk 'public' -> Storage::url akan mengembalikan '/storage/...'
        // lalu asset() akan membuatnya jadi http://127.0.0.1:8000/storage/...
        return asset(Storage::url($this->path));
        // alternatif langsung:
        // return asset('storage/' . ltrim($this->path, '/'));
    }
}
