<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingProposalModule extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_proposal_module_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingProposalModules::table();
        $trainingModuleTable = PgLaratrainingCreateTableTrainingModules::table();
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingModuleTable.".name as training_module_name,              

                    ".$trainingProposalTable.".name as training_proposal_name,              
                    ".$trainingProposalTable.".session as training_proposal_session,

                    ".$trainerTable.".matricule as trainer_matricule,              
                    ".$trainerTable.".email as trainer_email,              
                    ".$trainerTable.".name as trainer_name,              
                    ".$trainerTable.".gender as trainer_gender,              
                    ".$trainerTable.".phone1 as trainer_phone1,              
                    ".$trainerTable.".phone2 as trainer_phone2      
                FROM ".$mainTable." 
                    LEFT JOIN ".$trainingModuleTable." ON ".$trainingModuleTable.".id = ".$mainTable.".training_module_id
                    LEFT JOIN ".$trainingProposalTable." ON ".$trainingProposalTable.".id = ".$mainTable.".training_proposal_id
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
