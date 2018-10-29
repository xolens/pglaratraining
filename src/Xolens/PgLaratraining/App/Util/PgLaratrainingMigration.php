<?php

namespace Xolens\PgLaratraining\App\Util;

use Illuminate\Support\Facades\DB;
use PgLarautilCreateDatabaseLogTriggerFunction;

abstract class PgLaratrainingMigration extends AbstractPgLaratrainingMigration 
{
    public static function tablePrefix(){
        return config('xolens-pglaratraining.pglaratraining-database_table_prefix');
    }

    public static function triggerPrefix(){
        return config('xolens-pglaratraining.pglaratraining-database_trigger_prefix');
    }

    public static function logEnabled(){
        return config('xolens-pglaratraining.pglaratraining-enable_database_log');
    }
}
