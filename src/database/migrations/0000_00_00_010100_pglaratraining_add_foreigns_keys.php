<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;


class PgLaratrainingAddForeignsKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(PgLaratrainingCreateTableTrainingCenterConventions::table(), function (Blueprint $table) {
            $table->foreign('training_center_id')->references('id')->on(PgLaratrainingCreateTableTrainingCenters::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainingCenterPartners::table(), function (Blueprint $table) {
            $table->foreign('training_center_id')->references('id')->on(PgLaratrainingCreateTableTrainingCenters::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainingProposals::table(), function (Blueprint $table) {
            $table->foreign('training_center_id')->references('id')->on(PgLaratrainingCreateTableTrainingCenters::table())->onDelete('cascade');      
            $table->foreign('training_speciality_id')->references('id')->on(PgLaratrainingCreateTableTrainingSpecialities::table())->onDelete('cascade');      
            $table->foreign('training_type_id')->references('id')->on(PgLaratrainingCreateTableTrainingTypes::table())->onDelete('cascade');      
            $table->foreign('training_degree_id')->references('id')->on(PgLaratrainingCreateTableTrainingDegrees::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainingProposalLevels::table(), function (Blueprint $table) {
            $table->foreign('training_proposal_id')->references('id')->on(PgLaratrainingCreateTableTrainingProposals::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableStudentSubscriptions::table(), function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on(PgLaratrainingCreateTableStudents::table())->onDelete('cascade');      
            $table->foreign('scholarship_id')->references('id')->on(PgLaratrainingCreateTableScholarships::table())->onDelete('cascade');      
            $table->foreign('training_proposal_level_id')->references('id')->on(PgLaratrainingCreateTableTrainingProposalLevels::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainingProposalLevelModules::table(), function (Blueprint $table) {
            $table->foreign('trainer_id')->references('id')->on(PgLaratrainingCreateTableTrainers::table())->onDelete('cascade');      
            $table->foreign('training_proposal_level_id')->references('id')->on(PgLaratrainingCreateTableTrainingProposalLevels::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainerDegrees::table(), function (Blueprint $table) {
            $table->foreign('training_degree_id')->references('id')->on(PgLaratrainingCreateTableTrainingDegrees::table())->onDelete('cascade');      
            $table->foreign('trainer_id')->references('id')->on(PgLaratrainingCreateTableTrainers::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableStudentDegrees::table(), function (Blueprint $table) {
            $table->foreign('training_degree_id')->references('id')->on(PgLaratrainingCreateTableTrainingDegrees::table())->onDelete('cascade');      
            $table->foreign('student_id')->references('id')->on(PgLaratrainingCreateTableStudents::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainerDiseases::table(), function (Blueprint $table) {
            $table->foreign('disease_id')->references('id')->on(PgLaratrainingCreateTableDiseases::table())->onDelete('cascade');      
            $table->foreign('trainer_id')->references('id')->on(PgLaratrainingCreateTableTrainers::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableStudentDiseases::table(), function (Blueprint $table) {
            $table->foreign('disease_id')->references('id')->on(PgLaratrainingCreateTableDiseases::table())->onDelete('cascade');      
            $table->foreign('student_id')->references('id')->on(PgLaratrainingCreateTableStudents::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableTrainerHandicaps::table(), function (Blueprint $table) {
            $table->foreign('handicap_id')->references('id')->on(PgLaratrainingCreateTableHandicaps::table())->onDelete('cascade');      
            $table->foreign('trainer_id')->references('id')->on(PgLaratrainingCreateTableTrainers::table())->onDelete('cascade');      
        });
        Schema::table(PgLaratrainingCreateTableStudentHandicaps::table(), function (Blueprint $table) {
            $table->foreign('handicap_id')->references('id')->on(PgLaratrainingCreateTableHandicaps::table())->onDelete('cascade');      
            $table->foreign('student_id')->references('id')->on(PgLaratrainingCreateTableStudents::table())->onDelete('cascade');      
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table(PgLaratrainingCreateTableTrainingCenterConventions::table(), function (Blueprint $table) {
            $table->dropForeign(['training_center_id']);      
        });
        Schema::table(PgLaratrainingCreateTableTrainingCenterConventions::table(), function (Blueprint $table) {
            $table->dropForeign(['training_center_id']);      
        });
        Schema::table(PgLaratrainingCreateTableTrainingProposals::table(), function (Blueprint $table) {
            $table->dropForeign(['training_center_id','training_speciality_id','training_type_id','training_degree_id']);
        });
        Schema::table(PgLaratrainingCreateTableTrainingProposalLevels::table(), function (Blueprint $table) {
            $table->dropForeign(['training_proposal_id']);      
        });
        Schema::table(PgLaratrainingCreateTableStudentSubscriptions::table(), function (Blueprint $table) {
            $table->dropForeign(['student_id','scholarship_id','training_proposal_level_id']);
        });
        Schema::table(PgLaratrainingCreateTableStudentSubscriptions::table(), function (Blueprint $table) {
            $table->dropForeign(['student_id','scholarship_id','training_proposal_level_id']);
        });
        Schema::table(PgLaratrainingCreateTableTrainingProposalLevelModules::table(), function (Blueprint $table) {
            $table->dropForeign(['trainer_id','training_proposal_level_id']);
        });
        Schema::table(PgLaratrainingCreateTableTrainerDegrees::table(), function (Blueprint $table) {
            $table->dropForeign(['training_degree_id','trainer_id']);
        });
        Schema::table(PgLaratrainingCreateTableStudentDegrees::table(), function (Blueprint $table) {
            $table->dropForeign(['training_degree_id','student_id']);
        });
        Schema::table(PgLaratrainingCreateTableTrainerDiseases::table(), function (Blueprint $table) {
            $table->dropForeign(['disease_id','trainer_id']);
        });
        Schema::table(PgLaratrainingCreateTableStudentDiseases::table(), function (Blueprint $table) {
            $table->dropForeign(['disease_id','student_id']);
        });
        Schema::table(PgLaratrainingCreateTableTrainerHandicaps::table(), function (Blueprint $table) {
            $table->dropForeign(['handicap_id','trainer_id']);
        });
        Schema::table(PgLaratrainingCreateTableStudentHandicaps::table(), function (Blueprint $table) {
            $table->dropForeign(['handicap_id','student_id']);
        });
    }
}