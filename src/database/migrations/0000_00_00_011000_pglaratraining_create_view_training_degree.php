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
                        SELECT count(id) 
                        FROM ".$trainerDegreeTable." 
                        WHERE ".$mainTable.".id = ".$trainerDegreeTable.".training_degree_id
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
