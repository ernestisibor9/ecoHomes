<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default Service
    |--------------------------------------------------------------------------
    |
    | Specify the default service to use.
    |
    | Supported: "ipstack", "ipapi", "maxmind"
    |
    */
    'default' => env('GEOIP_DRIVER', 'ipstack'),

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    |
    | Configuration for the supported services.
    |
    */
    'services' => [

        'ipstack' => [
            'access_key' => env('IPSTACK_ACCESS_KEY'),
            'secure' => env('IPSTACK_SECURE', false),
        ],

        'ipapi' => [
            'key' => env('IPAPI_KEY', null),
            'secure' => env('IPAPI_SECURE', true),
        ],

        'maxmind' => [
            'user_id' => env('MAXMIND_USER_ID', ''),
            'license_key' => env('MAXMIND_LICENSE_KEY', ''),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | Cache settings for location data.
    |
    */
    'cache' => [
        'enabled' => true,
        'tag' => 'geoip',
        'duration' => 30,
    ],

];
