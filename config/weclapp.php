<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Weclapp API Configuration
    |--------------------------------------------------------------------------
    */

    // API Base URL
    'base_url' => env('WECLAPP_API_URL', 'https://YOUR_DOMAIN.weclapp.com/webapp/api/v1'),

    // API Authentication Token
    'api_token' => env('WECLAPP_API_TOKEN'),

    // Default timeout for API requests (in seconds)
    'timeout' => env('WECLAPP_TIMEOUT', 30),

    // Enable debug mode for detailed logging
    'debug' => env('WECLAPP_DEBUG', false),
];