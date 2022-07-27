# Laravel Simple Access Log

Many systems need to log user access for auditing purposes. This package creates a database table with sensible fields for logging access.

## Features
* Table structure to keep access logs
* Events for common access operations like login success, login failure, logout
* Configurable connection if using a different database for recording logs
* Use custom model

## Table fields
Migration schema to explain available fields.

```php
Schema::connection(config('simple-access-log.access_log_db_connection'))->create('lsac_access_logs', function (Blueprint $table) {
    $table->id();
    $table->dateTime('ac_date_time_local', $precision = 0)->index('ac_date_time_local_index')->comment('Timestamp in local timezone.');
    $table->dateTime('ac_date_time_utc', $precision = 0)->nullable()->index('ac_date_time_utc_index');
    $table->string('al_actor_id')->nullable()->index('al_actor_id_index')->comment('User id in application. Can be null in cases where an action is performed programmatically.');
    $table->string('ac_actor_type', 255)->nullable()->index('ac_actor_type_index')->comment('Actor type in application. Useful if you are logging multiple types of users. Example: admin, user, guest');
    $table->string('al_actor_global_uid')->nullable()->index('al_actor_global_uid_index')->comment('User id if using a single sign on facility.');
    $table->string('ac_actor_username', 255)->nullable()->index('ac_actor_username_index')->comment('Username in application.');
    $table->string('ac_actor_group', 255)->nullable()->index('ac_actor_group_index')->comment('User role/group in application.');
    $table->string('ac_device_id', 255)->nullable()->index('ac_device_id_index')->comment('Device identifier.');
    $table->string('ac_event_name', 255)->index('ac_event_name_index')->comment('Common name for the event that can be used to filter down to similar events. Example: user.login.success, user.login.failure, user.logout');
    $table->ipAddress('ac_ip_addr')->nullable()->index('ac_ip_addr_index');
    $table->string('ac_server', 255)->nullable()->index('ac_server_index')->comment('Server ids or names, server location. Example: uat, production, testing, 192.168.2.10');
    $table->string('ac_version', 255)->nullable()->index('ac_version_index')->comment('Version of the code/release that is sending the events.');
    $table->timestamps();
});
```
## Events
You can dispatch these events to record logs. You can also listen to these events if you want additional processing.
* LoginSucceeded
* LoginFailed
* LoggedOut

## Requirements

* [Composer](https://getcomposer.org/)
* [Laravel](http://laravel.com/)
* [MySQL 4.x +](https://www.mysql.com/) VARBINARY data type is available as from 4.x

## Installation

You can install this package on an existing Laravel project with using composer:

```bash
 $ composer require aliirfaan/laravel-simple-access-log
```

Register the ServiceProvider by editing **config/app.php** file and adding to providers array:

```php
  aliirfaan\LaravelSimpleAccessLog\SimpleAccessLogProvider::class,
```

Note: use the following for Laravel <5.1 versions:

```php
 'aliirfaan\LaravelSimpleAccessLog\SimpleAccessLogProvider',
```

Publish files with:

```bash
 $ php artisan vendor:publish --provider="aliirfaan\LaravelSimpleAccessLog\SimpleAccessLogProvider"
```

or by using only `php artisan vendor:publish` and select the `aliirfaan\LaravelSimpleAccessLog\SimpleAccessLogProvider` from the outputted list.

Apply the migrations:

```bash
 $ php artisan migrate
 ```

 ## Configuration

This package publishes an `simple-access-log.php` file inside your applications's `config` folder which contains the settings for this package. Most of the variables are bound to environment variables, but you are free to directly edit this file, or add the configuration keys to the `.env` file.

access_log_db_connection | String  
The database connection to use. Defaults to environment variable 'DB_CONNECTION'.

```php
'access_log_db_connection' => env('ACCESS_LOG_DB_CONNECTION', env('DB_CONNECTION'))
```
access_log_model | String
The model you want to use. The model must implement aliirfaan\LaravelSimpleAccessLog\Contracts\SimpleAccessLog

```php
'access_log_model' => aliirfaan\LaravelSimpleAccessLog\Models\SimpleAccessLog::class,
```
## Usage

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use aliirfaan\LaravelSimpleAccessLog\Events\LoginSucceeded; // event you want to dispatch

class TestController extends Controller
{
    public function test(Request $request)
    {
        try {

            // log access after operation
            $eventData = [
                'ac_date_time_local' => date('Y-m-d H:i:s'),
                'ac_date_time_utc' => date('Y-m-d H:i:s'),
                'ac_actor_id' => 5,
                'ac_actor_type' => 'Model/Customer',
                'ac_actor_global_uid'=> 5,
                'ac_actor_username' => 'actor username',
                'ac_actor_group' => 'actor group',
                'ac_device_id' => 5,
                'ac_event_name' => 'user.login.success',
                'ac_server' => 'uat',
                'ac_version'=> 'version',
                'ac_ip_addr'=> $request->ip()
            ];

            // dispatch event
            LoginSucceeded::dispatch($eventData);

        } catch (\Exception $e) {
            report($e);
        }
    }
}
```

### Custom model

You have have additional requirements for our audit logs. In this case, you can add columns using migation and use a custom model to use your new columns.

Add your custom model to the configuration file.

```php
<?php

namespace App\Models\AccessLog;

use Illuminate\Database\Eloquent\Model;
use aliirfaan\LaravelSimpleAccessLog\Contracts\SimpleAccessLog as SimpleAccessLogContract;
use aliirfaan\LaravelSimpleAccessLog\Models\SimpleAccessLog;

// custom class that extends base model and implements contract
class AccessLog extends SimpleAccessLog implements SimpleAccessLogContract
{
    public function __construct(array $attributes = [])
    {
        // add your additional columns to the fillable property
        $this->mergeFillable(['al_custom_field_1']);
        
        parent::__construct($attributes);
    }
}
```

Specify custom model to configuration file
```php
'access_log_model' => App\Models\AccessLog\AccessLog::class,
```

## License

The MIT License (MIT)

Copyright (c) 2020

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.