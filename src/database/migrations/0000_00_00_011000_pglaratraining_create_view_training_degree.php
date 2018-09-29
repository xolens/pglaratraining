<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingDegree extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_degree_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingDegrees::table();
        $studentDegreeTable = PgLaratrainingCreateTableStudentDegrees::table();
        $trainerDegreeTable = PgLaratrainingCreateTableTrainerDegrees::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(id) 
                        FROM ".$studentDegreeTable." 
                        WHERE ".$mainTable.".id = ".$studentDegreeTable.".training_degree_id
                    ) as student_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentDegreeTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentDegreeTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentDegreeTable.".training_degree_id AND ".$studentTable.".gender = 'M'
                    ) as student_m_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentDegreeTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentDegreeTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentDegreeTable.".training_degree_id AND ".$studentTable.".gender = 'F'
                    ) as student_f_count,
                    (
                        SELECT count(id) 
                        FROM ".$trainerDegreeTable." 
                        WHERE ".$mainTable.".id = ".$trainerDegreeTable.".training_degree_id
                    ) as trainer_count,
                    (
                        SELECT count(DISTINCT ".$trainerTable.".id) 
                        FROM ".$trainerDegreeTable." 
                        LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainerDegreeTable.".trainer_id
                        WHERE ".$mainTable.".id = ".$trainerDegreeTable.".training_degree_id AND ".$trainerTable.".gender = 'M'
                    ) as trainer_m_count,
                    (
                        SELECT count(DISTINCT ".$trainerTable.".id) 
                        FROM ".$trainerDegreeTable." 
                        LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainerDegreeTable.".trainer_id
                        WHERE ".$mainTable.".id = ".$trainerDegreeTable.".training_degree_id AND ".$trainerTable.".gender = 'F'
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
