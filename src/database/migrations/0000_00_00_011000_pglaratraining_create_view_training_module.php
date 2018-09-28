<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingModule extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_module_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingModules::table();
        $trainingProposalLevelModule = PgLaratrainingCreateTableTrainingProposalLevelModules::table();
        $trainingProposalLevel = PgLaratrainingCreateTableTrainingProposalLevels::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(DISTINCT ".$trainingProposalLevel.".training_proposal_id) 
                        FROM ".$trainingProposalLevelModule."
                        LEFT JOIN ".$trainingProposalLevel." ON ".$trainingProposalLevel.".id = ".$trainingProposalLevelModule.".training_proposal_level_id
                        WHERE ".$mainTable.".id = ".$trainingProposalLevelModule.".training_module_id
                    ) as training_proposal_count

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
