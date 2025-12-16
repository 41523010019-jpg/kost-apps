<?php

namespace App\Services;

use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Cache;

class MidtransConfig
{
    const GATEWAY = 'midtrans';

    public static function get(): array
    {
        return Cache::remember('midtrans_config', 300, function () {
            return [
                'server_key' => PaymentGateway::getValue(
                    self::GATEWAY,
                    'MIDTRANS_SERVER_KEY',
                    config('services.midtrans.server_key')
                ),

                'client_key' => PaymentGateway::getValue(
                    self::GATEWAY,
                    'MIDTRANS_CLIENT_KEY',
                    config('services.midtrans.client_key')
                ),

                'is_production' => filter_var(
                    PaymentGateway::getValue(
                        self::GATEWAY,
                        'MIDTRANS_IS_PRODUCTION',
                        config('services.midtrans.is_production')
                    ),
                    FILTER_VALIDATE_BOOLEAN
                ),
            ];
        });
    }

    public static function clearCache(): void
    {
        Cache::forget('midtrans_config');
    }
}
