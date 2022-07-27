<?php

namespace aliirfaan\LaravelSimpleAccessLog\Models;

use Illuminate\Database\Eloquent\Model;
use aliirfaan\LaravelSimpleAccessLog\Contracts\SimpleAccessLog as SimpleAccessLogContract;

class SimpleAccessLog extends Model implements SimpleAccessLogContract
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
        'ac_ip_addr'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->connection = config('simple-access-log.access_log_db_connection');
    }
}