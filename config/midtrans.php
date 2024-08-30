<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
    'is3ds' => env('MIDTRANS_IS_3DS', true),
    'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
];