<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainerDegree extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'trainer_degree_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainerDegrees::table();
        $trainingDegreesTable = PgLaratrainingCreateTableTrainingDegrees::table();
        $trainersTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW ".self::table()." AS(
                SELECT 
                    ".$mainTable.".*,                    

                    ".$trainingDegreesTable.".name as training_degree_name,              
                    ".$trainingDegreesTable.".degree_type as training_degree_type,              

                    ".$trainersTable.".matricule as trainer_matricule,              
                    ".$trainersTable.".email as trainer_email,              
                    ".$trainersTable.".name as trainer_name,              
                    ".$trainersTable.".gender as trainer_gender,              
                    ".$trainersTable.".phone1 as trainer_phone1,              
                    ".$trainersTable.".phone2 as trainer_phone2              

                FROM ".$mainTable." 
                    LEFT JOIN ".$trainingDegreesTable." ON ".$trainingDegreesTable.".id = ".$mainTable.".training_degree_id
                    LEFT JOIN ".$trainersTable." ON ".$trainersTable.".id = ".$mainTable.".trainer_id
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
