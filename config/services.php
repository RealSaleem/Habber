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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'hesabepayment' => [
     'version' => env('VERSION','2.0'),
      'payment_api_url' => env('PAYMENT_API_URL','https://sandbox.hesabe.com'),
       'access_code' => env('ACCESS_CODE','c333729b-d060-4b74-a49d-7686a8353481'),
      'merchant_secret_key' => env('MERCHANT_SECRET_KEY','PkW64zMe5NVdrlPVNnjo2Jy9nOb7v1Xg'),
      'merchant_iv' => env('MERCHANT_IV','5NVdrlPVNnjo2Jy9'),
      'merchant_code' => env('MERCHANT_CODE','842217'),
      'response_url' => env('RESPONSE_URL','http://habber.test/payment/success/?id=2'),
      'failure_url' => env('FAILURE_URL','http://habber.test/payment/failure/?id=842217'),
      'success_code' => env('SUCCESS_CODE','200'),
      'authentication_failed_code' => env('AUTHENTICATION_FAILED_CODE','501'),

    ],

];
