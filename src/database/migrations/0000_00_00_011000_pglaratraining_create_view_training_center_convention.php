<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainingCenterConvention extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_center_convention_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainingCenterConventions::table();
        $trainingCenterTable = PgLaratrainingCreateTableTrainingCenters::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingCenterTable.".matricule as training_center_matricule,              
                    ".$trainingCenterTable.".email as training_center_email,              
                    ".$trainingCenterTable.".name as training_center_name,              
                    ".$trainingCenterTable.".sigle as training_center_gender,              
                    ".$trainingCenterTable.".phone1 as training_center_phone1,              
                    ".$trainingCenterTable.".phone2 as training_center_phone2              

                FROM ".$mainTable." 
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
