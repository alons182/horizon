<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePropertiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('properties', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type');
			$table->string('code');
			$table->string('title');
			$table->text('description');
			$table->integer('furniture');
			$table->integer('bedrooms');
			$table->float('priced');
			$table->float('pricec')->nullable();
			$table->string('image')->nullable();
			$table->string('location');
			$table->string('city');
			$table->string('area')->nullable();
			$table->string('contact')->nullable();
			$table->integer('featured');
			$table->integer('publish');
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
		Schema::drop('properties');
	}

}
