<?php

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

    'mangadex' => [
        'grant_type' => env("MANGADEX_GRANT_TYPE"),
        'username' => env("MANGADEX_USERNAME"),
        'password' => env("MANGADEX_PASSWORD"),
        'client_id' => env("MANGADEX_CLIENT_ID"),
        'client_secret' => env("MANGADEX_CLIENT_SECRET"),
        "base_url" => env("MANGADEX_BASE_URL", "https://api.mangadex.org"),
        "auth_url" => env("MANGADEX_AUTH_URL", "https://auth.mangadex.org/realms/mangadex/protocol/openid-connect/token")
    ],
    'manhwa_clan' => [
        "base_url" => env("MANHWA_CLAN_BASE_URL", "https://manhwa-clan.vercel.app/api"),
    ]
];
