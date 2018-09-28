<?php

use Illuminate\Support\Facades\DB;
use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateViewTrainerHandicap extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'trainer_handicap_view';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mainTable = PgLaratrainingCreateTableTrainerHandicaps::table();
        $handicapTable = PgLaratrainingCreateTableHandicaps::table();
        $trainerTable = PgLaratrainingCreateTableTrainers::table();
        DB::statement("
            CREATE VIEW " . self::table() . " AS(
                SELECT 
                    " . $mainTable . ".*,                    

                    " . $handicapTable . ".name as handicap_name,              
                    " . $handicapTable . ".type as handicap_type,              

                    " . $trainerTable . ".matricule as trainer_matricule,              
                    " . $trainerTable . ".email as trainer_email,              
                    " . $trainerTable . ".name as trainer_name,              
                    " . $trainerTable . ".gender as trainer_gender,              
                    " . $trainerTable . ".phone1 as trainer_phone1,              
                    " . $trainerTable . ".phone2 as trainer_phone2              

                FROM " . $mainTable . " 
                    LEFT JOIN " . $handicapTable . " ON " . $handicapTable . ".id = " . $mainTable . ".handicap_id
                    LEFT JOIN " . $trainerTable . " ON " . $trainerTable . ".id = " . $mainTable . ".trainer_id
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
