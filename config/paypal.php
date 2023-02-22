<?php

return [
    'client_id' => env('PAYPAL_ID'),
    'client_secret' => env('PAYPAL_SECRET'),

    'settings' => env('PAYPAL_MODE','sandbox'),
    'http.ConnectionTimeOut' => 30,
    'log.LogEnabled' => true,
    'log.FileName' => storage_path('/logs/paypal.log'),
    'log.LogLevel' => 'ERROR'

];