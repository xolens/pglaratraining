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
        $trainingProposalLevelTable = PgLaratrainingCreateTableTrainingProposalLevels::table();
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

                    ".$trainingProposalLevelTable.".name as training_proposal_level_name,              
                    ".$trainingProposalLevelTable.".duration as training_proposal_level_duration,
                    ".$trainingProposalLevelTable.".session as training_proposal_level_session,
                    ".$trainingProposalLevelTable.".registration_fees as training_proposal_level_registration_fees,
                    ".$trainingProposalLevelTable.".registration_fees + ".$trainingProposalLevelTable.".training_fees 
                        as training_proposal_level_fees,
                        
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
                    LEFT JOIN ".$trainingProposalLevelTable." ON ".$trainingProposalLevelTable.".id = ".$mainTable.".training_proposal_level_id
                    LEFT JOIN ".$trainingProposalTable." ON ".$trainingProposalTable.".id = ".$trainingProposalLevelTable.".training_proposal_id
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
