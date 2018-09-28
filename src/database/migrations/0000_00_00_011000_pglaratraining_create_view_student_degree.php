<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewStudentDegree extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'student_degree_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableStudentDegrees::table();
        $trainingDegreesTable = PgLaratrainingCreateTableTrainingDegrees::table();
        $studentsTable = PgLaratrainingCreateTableStudents::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingDegreesTable.".name as training_degree_name,              
                    ".$trainingDegreesTable.".degree_type as training_degree_type,              

                    ".$studentsTable.".matricule as student_matricule,              
                    ".$studentsTable.".email as student_email,              
                    ".$studentsTable.".name as student_name,              
                    ".$studentsTable.".gender as student_gender,              
                    ".$studentsTable.".phone1 as student_phone1,              
                    ".$studentsTable.".phone2 as student_phone2              

                FROM ".$mainTable." 
                    LEFT JOIN ".$trainingDegreesTable." ON ".$trainingDegreesTable.".id = ".$mainTable.".training_degree_id
                    LEFT JOIN ".$studentsTable." ON ".$studentsTable.".id = ".$mainTable.".student_id
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
