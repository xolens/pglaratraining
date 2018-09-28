<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainer extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'trainer_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainers::table();
        $trainerDegreeTable = PgLaratrainingCreateTableTrainerDegrees::table();
        $trainerDiseaseTable = PgLaratrainingCreateTableTrainerDiseases::table();
        $trainerHandicapTable = PgLaratrainingCreateTableTrainerHandicaps::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(id) 
                        FROM ".$trainerDegreeTable." 
                        WHERE ".$mainTable.".id = ".$trainerDegreeTable.".trainer_id
                    ) as degree_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerDiseaseTable." 
                        WHERE ".$mainTable.".id = ".$trainerDiseaseTable.".trainer_id
                    ) as disease_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerHandicapTable." 
                        WHERE ".$mainTable.".id = ".$trainerHandicapTable.".trainer_id
                    ) as handicap_count

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
