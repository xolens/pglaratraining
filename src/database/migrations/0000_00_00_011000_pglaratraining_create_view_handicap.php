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
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
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
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentHandicapTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentHandicapTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentHandicapTable.".handicap_id AND ".$studentTable.".gender = 'M'
                    ) as student_m_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentHandicapTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentHandicapTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentHandicapTable.".handicap_id AND ".$studentTable.".gender = 'F'
                    ) as student_f_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerHandicapTable." 
                        WHERE ".$mainTable.".id = ".$trainerHandicapTable.".handicap_id
                    ) as trainer_count,
                    (
                        SELECT count(DISTINCT ".$trainerTable.".id) 
                        FROM ".$trainerHandicapTable." 
                        LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainerHandicapTable.".trainer_id
                        WHERE ".$mainTable.".id = ".$trainerHandicapTable.".handicap_id AND ".$trainerTable.".gender = 'M'
                    ) as trainer_m_count,
                    (
                        SELECT count(DISTINCT ".$trainerTable.".id) 
                        FROM ".$trainerHandicapTable." 
                        LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainerHandicapTable.".trainer_id
                        WHERE ".$mainTable.".id = ".$trainerHandicapTable.".handicap_id AND ".$trainerTable.".gender = 'F'
                    ) as trainer_f_count

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
