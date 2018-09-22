<?php

namespace Xolens\PgLaratraining\App\Util;

use Xolens\PgLarautil\App\Util\AbstractPgLarautilMigration;
use Illuminate\Support\Facades\DB;
use PgLarautilCreateDatabaseLogTriggerFunction;
use Xolens\PgLaratraining\App\Model\Domain;

abstract class AbstractPgLaratrainingMigration extends AbstractPgLarautilMigration 
{
    public static function registerForPreference($model){
        $model = new Domain(['table_name'=>self::table(),'model'=>$model]);
        $model->save();
        return $model;
    }

    public static function unregisterFromPreference(){
        Domain::where('table_name',self::table())->delete();
        return;
    }
}
