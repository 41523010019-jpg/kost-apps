<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    public function run(): void
    {
        PaymentGateway::setValue(
            'midtrans',
            'MIDTRANS_SERVER_KEY',
            env('MIDTRANS_SERVER_KEY')
        );

        PaymentGateway::setValue(
            'midtrans',
            'MIDTRANS_CLIENT_KEY',
            env('MIDTRANS_CLIENT_KEY')
        );

        PaymentGateway::setValue(
            'midtrans',
            'MIDTRANS_IS_PRODUCTION',
            env('MIDTRANS_IS_PRODUCTION', false)
        );
    }
}
