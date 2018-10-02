<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateTableStudents extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'students';
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
            $table->string('matricule')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('name');
            $table->enum('gender',['M','F']);
            
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('phone1')->unique();
            $table->string('phone2')->nullable();
            $table->string('person_to_contact')->nullable();
            $table->text('person_to_contact_description')->nullable();
            $table->string('person_to_contact_phone_1')->nullable();
            $table->string('person_to_contact_phone_2')->nullable();
            $table->text('description')->nullable();
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
