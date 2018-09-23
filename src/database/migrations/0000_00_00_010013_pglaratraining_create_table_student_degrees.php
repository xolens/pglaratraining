<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateTableStudentDegrees extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'student_degrees';
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
            $table->string('issued_institute')->nullable();
            $table->date('issued_date')->nullable();
            $table->integer('training_degree_id')->index();
            $table->integer('student_id')->index();
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
