<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewStudentDisease extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'student_disease_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableStudentDiseases::table();
        $diseaseTable = PgLaratrainingCreateTableDiseases::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$diseaseTable.".name as disease_name,              

                    ".$studentTable.".matricule as student_matricule,              
                    ".$studentTable.".email as student_email,              
                    ".$studentTable.".name as student_name,              
                    ".$studentTable.".gender as student_gender,              
                    ".$studentTable.".phone1 as student_phone1,              
                    ".$studentTable.".phone2 as student_phone2              

                FROM ".$mainTable." 
                    LEFT JOIN ".$diseaseTable." ON ".$diseaseTable.".id = ".$mainTable.".disease_id
                    LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$mainTable.".student_id
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
