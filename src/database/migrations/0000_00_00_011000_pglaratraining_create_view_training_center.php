<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingCenter extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_center_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingCenters::table();
        $conventionTable = PgLaratrainingCreateTableTrainingCenterConventions::table();
        $partnerTable = PgLaratrainingCreateTableTrainingCenterPartners::table();
        $trainingProposalTable = PgLaratrainingCreateTableTrainingProposals::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,
                    (
                        SELECT count(".$conventionTable.".id) 
                        FROM ".$conventionTable." 
                        WHERE ".$mainTable.".id = ".$conventionTable.".training_center_id
                    ) as convention_count,
                    (
                        SELECT count(".$partnerTable.".id) 
                        FROM ".$partnerTable." 
                        WHERE ".$mainTable.".id = ".$partnerTable.".training_center_id
                    ) as partner_count,
                    (
                        SELECT count(DISTINCT ".$trainingProposalTable.".training_speciality_id) 
                        FROM ".$trainingProposalTable." 
                        WHERE ".$mainTable.".id = ".$trainingProposalTable.".training_center_id
                    ) as speciality_count

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
