<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewDisease extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'disease_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableDiseases::table();
        $studentDiseaseTable = PgLaratrainingCreateTableStudentDiseases::table();
        $trainerDiseaseTable = PgLaratrainingCreateTableTrainerDiseases::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(id) 
                        FROM ".$studentDiseaseTable." 
                        WHERE ".$mainTable.".id = ".$studentDiseaseTable.".disease_id
                    ) as student_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerDiseaseTable." 
                        WHERE ".$mainTable.".id = ".$trainerDiseaseTable.".disease_id
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
