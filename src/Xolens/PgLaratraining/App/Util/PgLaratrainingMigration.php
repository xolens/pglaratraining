<?php

namespace Xolens\PgLaratraining\App\Util;

use Illuminate\Support\Facades\DB;
use PgLarautilCreateDatabaseLogTriggerFunction;

abstract class PgLaratrainingMigration extends AbstractPgLaratrainingMigration 
{
    public static function tablePrefix(){
        return config('xolens-config.pglaratraining-database_table_prefix');
    }

    public static function triggerPrefix(){
        return config('xolens-config.pglaratraining-database_trigger_prefix');
    }

    public static function logEnabled(){
        return config('xolens-config.pglaratraining-enable_database_log');
    }
}
