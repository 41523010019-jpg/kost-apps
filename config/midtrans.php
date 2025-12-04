<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    // Sandbox = false
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    // Recommended settings
    'is_sanitized' => true,
    'is_3ds' => true,
];
