<?php
/**
 * Stores configuration details for third-party services and couriers,
 * including URLs, credentials, and class mappings.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'from' => env('TWILIO_PHONE_NUMBER'),
    ],

    'admin_email' => env('ADMIN_EMAIL', 'admin@example.com'),

    'justin' => [
        'url' => env('JUSTIN_URL', 'http://justin.test/api/delivery/justin'),
        'sender_address' => env('JUSTIN_SENDER_ADDRESS', 'Kiev, St. Butlerova, 1'),
    ],

    'ukrposhta' => [
        'url' => env('UKRPOSHTA_URL', 'http://ukrposhta.test/api/delivery/ukrposhta'),
        'sender_address' => env('UKRPOSHTA_SENDER_ADDRESS', 'Kyiv. St. Soborna, 98'),
    ],

    'novaposhta' => [
        'url' => env('NOVAPOSHTA_URL', 'http://novaposhta.test/api/delivery/novaposhta'),
        'sender_address' => env('NOVAPOSHTA_SENDER_ADDRESS', 'Kyiv, St. Pirogovsky Shlyach, 135'),
    ],

    'courier_classes' => [
        'justin' => \App\Services\JustinCourier::class,
        'ukrposhta' => \App\Services\UkrPoshtaCourier::class,
        'novaposhta' => \App\Services\NovaPoshtaCourier::class,
    ],

    'default_courier' => env('DEFAULT_COURIER', 'novaposhta'),
];
