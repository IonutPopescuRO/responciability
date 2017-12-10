<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
	
	'facebook' => [
		'client_id' => '301135903709498',
		'client_secret' => '44be8616a86d2c3fbe0754bdeb79c63c',
		'redirect' => 'http://localhost:8000/login/facebook',
	],
	
	'google' => [
		'client_id' => '705020798668-mvannpvmjri7d0udnhesu49dn66cfui9.apps.googleusercontent.com',
		'client_secret' => 'LHPET598EIP8MiCsl8qV96_v',
		'redirect' => 'http://localhost:8000/login/google',
	],
	
	'twitter' => [
		'client_id' => 'jtgz55gwLfLv12sWywFYaXvJ7',
		'client_secret' => 'G8y5o4FpbSRitTicxu2nLfAhfTOLbK1ZsTh9XP7cWvAUieGpI6',
		'redirect' => 'http://localhost:8000/login/twitter',
	],

];
