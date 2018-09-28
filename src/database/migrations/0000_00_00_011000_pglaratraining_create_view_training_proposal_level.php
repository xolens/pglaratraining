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
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingProposalTable.".name as training_proposal_name,              
                    ".$trainingProposalTable.".total_fees as training_proposal_total_fees,              
                    ".$trainingProposalTable.".year as training_proposal_year,
                    (
                        SELECT count(DISTINCT ".$studentSubscriptionTable.".student_id) 
                        FROM ".$studentSubscriptionTable."
                        WHERE ".$mainTable.".id = ".$studentSubscriptionTable.".training_proposal_level_id
                    ) as student_subscription_count
                FROM ".$mainTable." 
                LEFT JOIN ".$trainingProposalTable." ON ".$mainTable.".training_proposal_id = ".$trainingProposalTable.".id
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
