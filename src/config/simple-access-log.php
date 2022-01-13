<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Access log configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings. You are free to adjust these settings as needed.
    |
    | access_log_db_connection | String
    | The database connection to use. Defaults to environment variable 'DB_CONNECTION'.
    */

    'access_log_db_connection' => env('ACCESS_LOG_DB_CONNECTION', env('DB_CONNECTION')),
];
