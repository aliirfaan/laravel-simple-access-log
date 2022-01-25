<?php

namespace aliirfaan\LaravelSimpleAccessLog\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $table = 'lsac_access_logs';

    protected $fillable = [
        'ac_date_time_local',
        'ac_date_time_utc',
        'ac_actor_id',
        'ac_actor_type',
        'ac_actor_global_uid',
        'ac_actor_username',
        'ac_actor_group',
        'ac_device_id',
        'ac_event_name',
        'ac_server',
        'ac_version',
        'ac_ip_addr',
        'ac_custom_field_1',
        'ac_custom_field_2',
        'ac_custom_field_3',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('simple-access-log.access_log_db_connection');
    }
}