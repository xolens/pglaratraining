<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainerDisease extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'trainer_disease_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainerDiseases::table();
        $diseaseTable = PgLaratrainingCreateTableDiseases::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$diseaseTable.".name as disease_name,              

                    ".$trainerTable.".matricule as trainer_matricule,              
                    ".$trainerTable.".email as trainer_email,              
                    ".$trainerTable.".name as trainer_name,              
                    ".$trainerTable.".gender as trainer_gender,              
                    ".$trainerTable.".phone1 as trainer_phone1,              
                    ".$trainerTable.".phone2 as trainer_phone2              

                FROM ".$mainTable." 
                    LEFT JOIN ".$diseaseTable." ON ".$diseaseTable.".id = ".$mainTable.".disease_id
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
