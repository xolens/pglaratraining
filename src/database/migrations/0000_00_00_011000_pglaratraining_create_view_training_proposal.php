<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingProposal extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_proposal_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingProposals::table();
        $trainingDegreeTable = PgLaratrainingCreateTableTrainingDegrees::table();
        $trainingSpecialitieTable = PgLaratrainingCreateTableTrainingSpecialities::table();
        $trainingTypeTable = PgLaratrainingCreateTableTrainingTypes::table();
        $trainingCenterTable = PgLaratrainingCreateTableTrainingCenters::table();
        
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainingProposalModuleTable = PgLaratrainingCreateTableTrainingProposalModules::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                WITH selection1 as (
                    SELECT 
                        ".$studentSubscriptionTable.".training_proposal_id,
                        COUNT(".$studentTable.".id) as student_count,
                        COUNT(CASE WHEN ".$studentTable.".gender = 'M' THEN 1 END) as student_m_count,
                        COUNT(CASE WHEN ".$studentTable.".gender = 'F' THEN 1 END) as student_f_count
                    FROM ".$studentSubscriptionTable." 
                    LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentSubscriptionTable.".student_id
                    GROUP BY ".$studentSubscriptionTable.".training_proposal_id
                ),
                selection2 as (
                    SELECT 
                        ".$trainingProposalModuleTable.".training_proposal_id,
                        COUNT(".$trainerTable.".id) as trainer_count,
                        COUNT(CASE WHEN ".$trainerTable.".gender = 'M' THEN 1 END) as trainer_m_count,
                        COUNT(CASE WHEN ".$trainerTable.".gender = 'F' THEN 1 END) as trainer_f_count
                    FROM ".$trainingProposalModuleTable." 
                    LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainingProposalModuleTable.".trainer_id
                    GROUP BY ".$trainingProposalModuleTable.".training_proposal_id
                )
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingDegreeTable.".name as training_degree_name,              
                    ".$trainingDegreeTable.".degree_type as training_degree_type,              

                    ".$trainingSpecialitieTable.".name as training_speciality_name,              

                    ".$trainingTypeTable.".name as training_type_name, 

                    ".$trainingCenterTable.".matricule as training_center_matricule,       
                    ".$trainingCenterTable.".name as training_center_name,       
                    ".$trainingCenterTable.".sigle as training_center_sigle,       
                    ".$trainingCenterTable.".email as training_center_email,
                    ".$trainingCenterTable.".phone1 as training_center_phone1,
                    ".$trainingCenterTable.".phone2 as training_center_phone2,

                    COALESCE(selection1.student_m_count , 0) as student_m_count,
                    COALESCE(selection1.student_f_count , 0) as student_f_count,
                    COALESCE(selection1.student_count , 0) as student_count,
                    COALESCE(selection2.trainer_m_count , 0) as trainer_m_count,
                    COALESCE(selection2.trainer_f_count , 0) as trainer_f_count,
                    COALESCE(selection2.trainer_count , 0) as trainer_count

                FROM ".$mainTable." 
                    LEFT JOIN ".$trainingDegreeTable." ON ".$trainingDegreeTable.".id = ".$mainTable.".training_degree_id
                    LEFT JOIN ".$trainingSpecialitieTable." ON ".$trainingSpecialitieTable.".id = ".$mainTable.".training_speciality_id
                    LEFT JOIN ".$trainingTypeTable." ON ".$trainingTypeTable.".id = ".$mainTable.".training_type_id
                    LEFT JOIN ".$trainingCenterTable." ON ".$trainingCenterTable.".id = ".$mainTable.".training_center_id
    
                    LEFT JOIN selection1 ON ".$mainTable.".id = selection1.training_proposal_id
                    LEFT JOIN selection2 ON ".$mainTable.".id = selection2.training_proposal_id
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
