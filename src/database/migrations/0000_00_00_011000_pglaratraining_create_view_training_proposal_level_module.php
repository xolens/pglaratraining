<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingProposalLevelModule extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_proposal_level_module_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingProposalLevelModules::table();
        $trainingModuleTable = PgLaratrainingCreateTableTrainingModules::table();
        $trainingProposalLevelTable = PgLaratrainingCreateTableTrainingProposalLevels::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingModuleTable.".name as training_module_name,              

                    ".$trainingProposalLevelTable.".name as training_proposal_level_name,              
                    ".$trainingProposalLevelTable.".session as training_proposal_level_session,

                    ".$trainerTable.".matricule as trainer_matricule,              
                    ".$trainerTable.".email as trainer_email,              
                    ".$trainerTable.".name as trainer_name,              
                    ".$trainerTable.".gender as trainer_gender,              
                    ".$trainerTable.".phone1 as trainer_phone1,              
                    ".$trainerTable.".phone2 as trainer_phone2      
                FROM ".$mainTable." 
                    LEFT JOIN ".$trainingModuleTable." ON ".$trainingModuleTable.".id = ".$mainTable.".training_module_id
                    LEFT JOIN ".$trainingProposalLevelTable." ON ".$trainingProposalLevelTable.".id = ".$mainTable.".training_proposal_level_id
                    LEFT JOIN ".$trainerTable." ON ".$trainerTable.".id = ".$mainTable.".trainer_id
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
