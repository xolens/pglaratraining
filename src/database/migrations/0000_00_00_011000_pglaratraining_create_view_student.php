<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewStudent extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'student_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableStudents::table();
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        $studentDegreeTable = PgLaratrainingCreateTableStudentDegrees::table();
        $studentDiseaseTable = PgLaratrainingCreateTableStudentDiseases::table();
        $studentHandicapTable = PgLaratrainingCreateTableStudentHandicaps::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(".$studentSubscriptionTable.".id) 
                        FROM ".$studentSubscriptionTable." 
                        WHERE ".$mainTable.".id = ".$studentSubscriptionTable.".student_id
                    ) as subscription_count,
                    (
                        SELECT count(".$studentDegreeTable.".id) 
                        FROM ".$studentDegreeTable." 
                        WHERE ".$mainTable.".id = ".$studentDegreeTable.".student_id
                    ) as degree_count,
                    (
                        SELECT count(".$studentDiseaseTable.".id) 
                        FROM ".$studentDiseaseTable." 
                        WHERE ".$mainTable.".id = ".$studentDiseaseTable.".student_id
                    ) as disease_count,
                    (
                        SELECT count(".$studentHandicapTable.".id) 
                        FROM ".$studentHandicapTable." 
                        WHERE ".$mainTable.".id = ".$studentHandicapTable.".student_id
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
