<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = [
        'gateway',
        'key',
        'value',
    ];

    /* =========================
     * Helpers
     * ========================= */

    public static function getValue(string $gateway, string $key, $default = null)
    {
        return static::where('gateway', $gateway)
            ->where('key', $key)
            ->value('value') ?? $default;
    }

    public static function setValue(string $gateway, string $key, $value): void
    {
        static::updateOrCreate(
            [
                'gateway' => $gateway,
                'key'     => $key,
            ],
            [
                'value' => $value,
            ]
        );
    }
}
