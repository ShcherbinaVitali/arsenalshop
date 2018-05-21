<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {
	
	const DEFAULT_PARENT_ID = 0;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('alias');
			$table->integer('parent_id')->default($this::DEFAULT_PARENT_ID);
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('categories');
	}
}
