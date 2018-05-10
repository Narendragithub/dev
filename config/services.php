<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'sandbox16186e8a3e0b49b4a4ce7f6af7005e58.mailgun.org',
        'secret' => 'key-4fd559e50f8e08dede6c914bc5bf70cc',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => '',
        'key' => '',
        'secret' => '',
    ],
    'github' => [
        'client_id' => 'your-github-app-id',
        'client_secret' => 'your-github-app-secret',
        'redirect' => 'http://your-callback-url',
    ],
    'google' => [
        'client_id' => '814731236395-e03afjj5vov7upc70ua3g1s7d0ifv596.apps.googleusercontent.com',
        'client_secret' => 'J788PNEyR8xRBd5o8MUUmKfp',
        'redirect' => 'http://cubedots.codeadroits.com/account/google',
    ],
    'facebook' => [
        'client_id' => '202990681544',
        'client_secret' => '085284bda0c18ea4938d80116dd2f62d',
        'redirect' => 'http://cubedots.codeadroits.com/account/facebook',
    ],
];
