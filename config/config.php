<?php

return array(
    /*
    |--------------------------------------------------------------------------
    | API URL
    |--------------------------------------------------------------------------
    |
    | This value determines which roketin engine API your application is currently
    | using. the default value is Development API in http://r-gateway.roketin.com/api/v1/
    | you can set this value from .env file
     */

    'api'             => env('ROKETIN_API', 'https://api.stellar.roketin.com'),

    'api-key'         => env('ROKETIN_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | PUBLIC URL
    |--------------------------------------------------------------------------
    |
    | This value determines which PUBLIC URL your application is currently
    | using for fetching pictures/photos/files. the default value is Development
    | API in http://r-gateway.roketin.com/ you can set this value from .env file
     */

    'public_url'      => env('ROKETIN_PUBLIC', 'https://api.stellar.roketin.com'),

    /*
    |--------------------------------------------------------------------------
    | ROKETIN API CREDENTIAL
    |--------------------------------------------------------------------------
    |
    | This field is for storing the credentials for Roketin API services
    | you can set this value from .env file
     */

    'company-token'   => env('ROKETIN_TOKEN'),
    'client-username' => env('ROKETIN_USERNAME'),
    'client-token-rx' => env('ROKETIN_RX'),

    /*
    |--------------------------------------------------------------------------
    | VERITRANS API CREDENTIAL
    |--------------------------------------------------------------------------
    |
    | This field is for storing the credentials for Third Party Payment Gateway
    | Veritrans services
    | you can set this value from .env file
     */

    'vt-server'       => env('VERITRANS_SERVER'),
    'vt-environment'  => env('VERITRANS_ENVIRONMENT'),

    /*
    |--------------------------------------------------------------------------
    | ROKETIN ENCRYPTION KEY
    |--------------------------------------------------------------------------
    |
    | You should never edit this value unless you know what are you doing.
     */

    'encryption_key'  => '494EE0E7108057BC15597DACA94D1F43',
);
