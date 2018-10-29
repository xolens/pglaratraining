<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateTableTrainingProposals extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_proposals';
    }    

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::table(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('year');

            $table->integer('duration');
            $table->string('session');
            $table->integer('registration_fees');
            $table->integer('training_fees');
            $table->integer('training_capacity');

            $table->text('description')->nullable();
            $table->integer('training_center_id')->index();
            $table->integer('training_speciality_id')->index();
            $table->integer('training_type_id')->index();
            $table->integer('training_degree_id')->index()->nullable();
            
            $table->unique(['name', 'training_center_id']);
        });
        if(self::logEnabled()){
            self::registerForLog();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(self::logEnabled()){
            self::unregisterFromLog();
        }
        Schema::dropIfExists(self::table());

    }
}
