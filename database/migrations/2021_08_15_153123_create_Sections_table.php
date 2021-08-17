<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	public function up()
	{
		Schema::create('Sections', function(Blueprint $table) {
			$table->id();
			$table->string('Name_section');
			$table->integer('Status');
            $table->bigInteger('Grade_id')->unsigned();
            $table->bigInteger('class_id')->unsigned();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Sections');
	}
}
