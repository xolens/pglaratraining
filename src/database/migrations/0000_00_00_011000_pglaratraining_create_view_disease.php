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
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(DISTINCT ".$studentDiseaseTable.".student_id) 
                        FROM ".$studentDiseaseTable." 
                        WHERE ".$mainTable.".id = ".$studentDiseaseTable.".disease_id
                    ) as student_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentDiseaseTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentDiseaseTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentDiseaseTable.".disease_id AND ".$studentTable.".gender = 'M'
                    ) as student_m_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentDiseaseTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentDiseaseTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentDiseaseTable.".disease_id AND ".$studentTable.".gender = 'F'
                    ) as student_f_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerDiseaseTable." 
                        WHERE ".$mainTable.".id = ".$trainerDiseaseTable.".disease_id
                    ) as trainer_count,
                    (
                        SELECT count(DISTINCT ".$trainerTable.".id) 
                        FROM ".$trainerDiseaseTable." 
                        LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainerDiseaseTable.".trainer_id
                        WHERE ".$mainTable.".id = ".$trainerDiseaseTable.".disease_id AND ".$trainerTable.".gender = 'M'
                    ) as trainer_m_count,
                    (
                        SELECT count(DISTINCT ".$trainerTable.".id) 
                        FROM ".$trainerDiseaseTable." 
                        LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainerDiseaseTable.".trainer_id
                        WHERE ".$mainTable.".id = ".$trainerDiseaseTable.".disease_id AND ".$trainerTable.".gender = 'F'
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
