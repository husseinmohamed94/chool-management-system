<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_grade');
            $table->unsignedBigInteger('from_classroom');
            $table->unsignedBigInteger('from_setion');
            $table->unsignedBigInteger('to_grade');
            $table->unsignedBigInteger('to_classroom');
            $table->unsignedBigInteger('to_section');
            $table->string('academic_year');
            $table->string('academic_year_new');

            $table->timestamps();
        });
        Schema::table('promotions', function(Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->foreign('from_grade')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('from_classroom')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('from_setion')->references('id')->on('Sections')->onDelete('cascade');

            $table->foreign('to_grade')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('to_classroom')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('to_section')->references('id')->on('Sections')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
