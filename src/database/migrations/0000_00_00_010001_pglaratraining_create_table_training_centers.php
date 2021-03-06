<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

use Xolens\PgLaratraining\App\Util\PgLaratrainingMigration;

class PgLaratrainingCreateTableTrainingCenters extends PgLaratrainingMigration
{
    /**
     * Return table name
     *
     * @return string
     */
    public static function tableName(){
        return 'training_centers';
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
            $table->string('sigle');
            $table->string('mailbox_number');
            $table->string('mailbox_city');
            $table->string('phone1')->unique();
            $table->string('phone2')->nullable();
            $table->string('website')->nullable();
            $table->integer('creation_year');
            $table->string('creation_order_number')->nullable();
            $table->date('creation_order_date')->nullable();
            $table->integer('opening_year')->nullable();
            $table->string('promoter_name')->nullable();;
            $table->enum('promoter_gender',['M','F'])->nullable();
            
            $table->integer('local_array')->nullable();
            $table->boolean('local_title')->default(false);
            $table->string('local_property')->nullable(); // Enum
            $table->string('manager_name')->nullable();;
            $table->string('center_type'); // Enum
            $table->string('center_order'); // Enum
            $table->date('approval_date')->nullable();
            $table->string('approval_order_number')->nullable();
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
