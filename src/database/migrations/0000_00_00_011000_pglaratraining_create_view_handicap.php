<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewHandicap extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'handicap_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableHandicaps::table();
        $studentHandicapTable = PgLaratrainingCreateTableStudentHandicaps::table();
        $trainerHandicapTable = PgLaratrainingCreateTableTrainerHandicaps::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(id) 
                        FROM ".$studentHandicapTable." 
                        WHERE ".$mainTable.".id = ".$studentHandicapTable.".handicap_id
                    ) as student_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerHandicapTable." 
                        WHERE ".$mainTable.".id = ".$trainerHandicapTable.".handicap_id
                    ) as trainer_count

                from ".$mainTable."
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS ".self::table());
    }
}
