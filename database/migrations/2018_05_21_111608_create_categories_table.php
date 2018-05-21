<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {
	
	const TABLE_NAME        = 'categories';
	const DEFAULT_PARENT_ID = 0;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(self::TABLE_NAME, function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('alias');
			$table->integer('parent_id')->default(self::DEFAULT_PARENT_ID);
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists(self::TABLE_NAME);
	}
}
