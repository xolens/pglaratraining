<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingSpeciality extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_speciality_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingSpecialities::table();
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(DISTINCT ".$trainingProposalTable.".id) 
                        FROM ".$trainingProposalTable."
                        WHERE ".$mainTable.".id = ".$trainingProposalTable.".training_speciality_id
                    ) as training_proposal_count
                FROM ".$mainTable."
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
