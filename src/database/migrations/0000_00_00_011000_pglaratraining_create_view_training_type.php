<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingType extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_type_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingTypes::table();
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        $trainingProposalLevelTable = PgLaratrainingCreateTableTrainingProposalLevels::table();
        $studentSubscriptionTable = PgLaratrainingCreateTableStudentSubscriptions::table();
        $trainingProposalLevelModuleTable = PgLaratrainingCreateTableTrainingProposalLevelModules::table();
        $studentTable = PgLaratrainingCreateTableStudents::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                WITH selection1 as (
                    SELECT 
                        ".$mainTable.".id,                    
                        ".$mainTable.".name,                    
                        ".$trainingProposalTable.".year as training_proposal_year,
                        ".$trainingProposalLevelTable.".id as training_proposal_level_id
                        
                    FROM ".$mainTable." 
                    LEFT JOIN ".$trainingProposalTable." ON ".$trainingProposalTable.".training_type_id = ".$mainTable.".id
                    LEFT JOIN ".$trainingProposalLevelTable." ON ".$trainingProposalLevelTable.".training_proposal_id = ".$trainingProposalTable.".id
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
                    selection1.id,
                    selection1.name,
                    selection1.training_proposal_year,
                    SUM(COALESCE(selection2.student_m_count , 0)) as student_m_count,
                    SUM(COALESCE(selection2.student_f_count , 0)) as student_f_count,
                    SUM(COALESCE(selection2.student_count , 0)) as student_count,
                    SUM(COALESCE(selection3.trainer_m_count , 0)) as trainer_m_count,
                    SUM(COALESCE(selection3.trainer_f_count , 0)) as trainer_f_count,
                    SUM(COALESCE(selection3.trainer_count , 0)) as trainer_count
                FROM selection1 
                LEFT JOIN selection2 USING (training_proposal_level_id)
                LEFT JOIN selection3 USING (training_proposal_level_id)
                GROUP BY selection1.training_proposal_year, selection1.id, selection1.name
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
