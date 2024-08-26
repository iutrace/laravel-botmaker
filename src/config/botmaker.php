<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Botmaker API Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Botmaker API. All API requests will be made
    | to this URL. Ensure that it's correctly set in your .env file.
    |
    */

    'base_url' => env('BOTMAKER_BASE_URL', 'https://api.botmaker.com/'),

    /*
    |--------------------------------------------------------------------------
    | Botmaker Access Token
    |--------------------------------------------------------------------------
    |
    | This is the access token required to authenticate and interact with
    | the Botmaker API. Store this value securely and load it from your
    | environment file.
    |
    */

    'access_token' => env('BOTMAKER_ACCESS_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Botmaker WhatsApp Number
    |--------------------------------------------------------------------------
    |
    | The default WhatsApp number associated with your Botmaker account. This
    | number will be used as the sender in communications. Ensure it's set
    | correctly in your .env file.
    |
    */

    'whatsapp_number' => env('BOTMAKER_WHATSAPP_NUMBER', ''),
];