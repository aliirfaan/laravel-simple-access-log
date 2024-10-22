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
    |
    | access_log_model | String
    | The model you want to use. The model must implement aliirfaan\LaravelSimpleAccessLog\Contracts\SimpleAccessLog
    |
    | should_prune | Bool
    | Whether to prune
    |
    | prune_days | Numeric
    | Prune days
    */

    'access_log_db_connection' => env('ACCESS_LOG_DB_CONNECTION', env('DB_CONNECTION')),
    'access_log_model' => aliirfaan\LaravelSimpleAccessLog\Models\SimpleAccessLog::class,
    'should_prune' => env('ACCESS_LOG_SHOULD_PRUNE', false),
    'prune_days' => env('ACCESS_LOG_PRUNE_DAYS', 60),
];
