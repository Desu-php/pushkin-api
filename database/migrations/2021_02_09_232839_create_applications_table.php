<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contest_id')->constrained('contests');
            $table->foreignId('age_group_id')->constrained('age_groups');
            $table->foreignId('theme_id')->constrained('themes');
            $table->foreignId('user_id')->constrained('users')->default('1');
            $table->foreignId('status_id')->constrained('application_statuses');
            $table->foreignId('teacher_id')->constrained('teachers')->nullable();
            $table->foreignId('educational_institution_id')->constrained('educational_institutions');
            $table->foreignId('region_id')->constrained('regions');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('link_contest_work')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
