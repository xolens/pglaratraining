<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingProposalLevel extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_proposal_level_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingProposalLevels::table();
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainingProposalLevelModuleTable = PgLaratrainingCreateTableTrainingProposalLevelModules::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                WITH selection1 as (
                    SELECT 
                        ".$mainTable.".*,                    

                        ".$trainingProposalTable.".name as training_proposal_name,              
                        ".$trainingProposalTable.".total_fees as training_proposal_total_fees,              
                        ".$trainingProposalTable.".year as training_proposal_year
                        
                    FROM ".$mainTable." 
                    LEFT JOIN ".$trainingProposalTable." ON ".$mainTable.".training_proposal_id = ".$trainingProposalTable.".id
                ),
                selection2 as (
                    SELECT 
                        ".$studentSubscriptionTable.".training_proposal_level_id,
                        COUNT(".$studentTable.".id) as student_count,
                        COUNT(CASE WHEN ".$studentTable.".gender = 'M' THEN 1 END) as student_m_count,
                        COUNT(CASE WHEN ".$studentTable.".gender = 'F' THEN 1 END) as student_f_count
                    FROM ".$studentSubscriptionTable." 
                    LEFT JOIN ".$studentTable." ON ".$studentTable.".id = ".$studentSubscriptionTable.".student_id
                    GROUP BY ".$studentSubscriptionTable.".training_proposal_level_id
                ),
                selection3 as (
                    SELECT 
                        ".$trainingProposalLevelModuleTable.".training_proposal_level_id,
                        COUNT(".$trainerTable.".id) as trainer_count,
                        COUNT(CASE WHEN ".$trainerTable.".gender = 'M' THEN 1 END) as trainer_m_count,
                        COUNT(CASE WHEN ".$trainerTable.".gender = 'F' THEN 1 END) as trainer_f_count
                    FROM ".$trainingProposalLevelModuleTable." 
                    LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$trainingProposalLevelModuleTable.".trainer_id
                    GROUP BY ".$trainingProposalLevelModuleTable.".training_proposal_level_id
                )
                SELECT 
                    selection1.*,
                    COALESCE(selection2.student_m_count , 0) as student_m_count,
                    COALESCE(selection2.student_f_count , 0) as student_f_count,
                    COALESCE(selection2.student_count , 0) as student_count,
                    COALESCE(selection3.trainer_m_count , 0) as trainer_m_count,
                    COALESCE(selection3.trainer_f_count , 0) as trainer_f_count,
                    COALESCE(selection3.trainer_count , 0) as trainer_count
                FROM selection1 
                LEFT JOIN selection2 ON selection1.id = selection2.training_proposal_level_id
                LEFT JOIN selection3 ON selection1.id = selection3.training_proposal_level_id
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
