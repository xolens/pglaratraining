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
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainingProposalLevelTable = PgLaratrainingCreateTableTrainingProposalLevels::table();
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
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
                    ".$trainingCenterTable.".phone2 as training_center_phone2

                FROM ".$mainTable." 
                    LEFT JOIN ".$trainingDegreeTable." ON ".$trainingDegreeTable.".id = ".$mainTable.".training_degree_id
                    LEFT JOIN ".$trainingSpecialitieTable." ON ".$trainingSpecialitieTable.".id = ".$mainTable.".training_speciality_id
                    LEFT JOIN ".$trainingTypeTable." ON ".$trainingTypeTable.".id = ".$mainTable.".training_type_id
                    LEFT JOIN ".$trainingCenterTable." ON ".$trainingCenterTable.".id = ".$mainTable.".training_center_id
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
