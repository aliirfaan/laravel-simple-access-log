<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLsacAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('simple-access-log.access_log_db_connection'))->create('lsac_access_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ac_date_time', $precision = 0)->index('ac_date_time_index');
            $table->string('ac_actor_id')->nullable()->index('ac_actor_id_index')->comment('User id in application. Can be null in cases where an action is performed programmatically.');
            $table->string('ac_actor_type', 255)->nullable()->index('ac_actor_type_index')->comment('Actor type in application. Useful if you are logging multiple types of users. Example: admin, user, guest');
            $table->string('ac_actor_globac_uid')->nullable()->index('ac_actor_globac_uid_index')->comment('User id if using a single sign on facility.');
            $table->string('ac_actor_username', 255)->nullable()->index('ac_actor_username_index')->comment('Username in application.');
            $table->string('ac_actor_group', 255)->nullable()->index('ac_actor_group_index')->comment('User role/group in application.');
            $table->string('ac_device_id', 255)->nullable()->index('ac_device_id_index')->comment('Device identifier.');
            $table->string('ac_event_name', 255)->nullable()->index('ac_event_name_index')->comment('Common name for the event that can be used to filter down to similar events. Example: user.login.success, user.login.failure, user.logout');
            $table->ipAddress('ac_ip_addr')->nullable()->index('ac_ip_addr_index');
            $table->string('ac_server', 255)->nullable()->index('ac_server_index')->comment('Server ids or names, server location. Example: uat, production, testing, 192.168.2.10');
            $table->string('ac_version', 255)->nullable()->index('ac_version_index')->comment('Version of the code/release that is sending the events.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('simple-access-log.access_log_db_connection'))->dropIfExists('lsac_access_logs');
    }
}
