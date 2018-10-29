<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewStudentSubscription extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'student_subscription_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $studentScholarshipTable = PgLaratrainingCreateTableScholarships::table();
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        $trainingCenterTable = PgLaratrainingCreateTableTrainingCenters::table();
        $trainingSpecialityTable = PgLaratrainingCreateTableTrainingSpecialities::table();

        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$studentTable.".matricule as student_matricule,              
                    ".$studentTable.".email as student_email,              
                    ".$studentTable.".name as student_name,              
                    ".$studentTable.".gender as student_gender,              
                    ".$studentTable.".phone1 as student_phone1,              
                    ".$studentTable.".phone2 as student_phone2,              

                    ".$studentScholarshipTable.".name as scholarship_name,              
                    ".$studentScholarshipTable.".value as scholarship_value,              

                    ".$trainingProposalTable.".name as training_proposal_name,              
                    ".$trainingProposalTable.".duration as training_proposal_duration,
                    ".$trainingProposalTable.".session as training_proposal_session,
                    ".$trainingProposalTable.".registration_fees as training_proposal_registration_fees,
                    ".$trainingProposalTable.".registration_fees + ".$trainingProposalTable.".training_fees 
                        as training_proposal_fees,
                        
                    ".$trainingProposalTable.".year as training_proposal_year,

                    ".$trainingSpecialityTable.".name as training_speciality_name,

                    ".$trainingCenterTable.".matricule as training_center_matricule,              
                    ".$trainingCenterTable.".name as training_center_name,              
                    ".$trainingCenterTable.".email as training_center_email,              
                    ".$trainingCenterTable.".phone1 as training_center_phone1,              
                    ".$trainingCenterTable.".phone2 as training_center_phone2              

                FROM ".$mainTable." 
                    LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$mainTable.".student_id
                    LEFT JOIN ".$studentScholarshipTable." ON ".$studentScholarshipTable.".id = ".$mainTable.".scholarship_id
                    LEFT JOIN ".$trainingProposalTable." ON ".$trainingProposalTable.".id = ".$mainTable.".training_proposal_id
                    LEFT JOIN ".$trainingCenterTable." ON ".$trainingCenterTable.".id = ".$trainingProposalTable.".training_center_id
                    LEFT JOIN ".$trainingSpecialityTable." ON ".$trainingSpecialityTable.".id = ".$trainingProposalTable.".training_speciality_id
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
