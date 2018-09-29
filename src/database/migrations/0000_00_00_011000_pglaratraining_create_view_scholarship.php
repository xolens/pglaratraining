<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewScholarship extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'scholarship_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableScholarships::table();
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(DISTINCT ".$studentSubscriptionTable.".student_id) 
                        FROM ".$studentSubscriptionTable." 
                        WHERE ".$mainTable.".id = ".$studentSubscriptionTable.".scholarship_id
                    ) as student_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentSubscriptionTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentSubscriptionTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentSubscriptionTable.".scholarship_id AND ".$studentTable.".gender = 'M'
                    ) as student_m_count,
                    (
                        SELECT count(DISTINCT ".$studentTable.".id) 
                        FROM ".$studentSubscriptionTable." 
                        LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentSubscriptionTable.".student_id
                        WHERE ".$mainTable.".id = ".$studentSubscriptionTable.".scholarship_id AND ".$studentTable.".gender = 'F'
                    ) as student_f_count
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
