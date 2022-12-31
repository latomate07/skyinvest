<?php

return [
    'credentials' => [
        'secret_key' => env('STRIPE_SK'),
        'public_key' => env('STRIPE_PK')
    ]
];