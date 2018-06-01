<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToProducts extends Migration {
	
	const TABLE_NAME = 'products';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table(self::TABLE_NAME, function(Blueprint $table) {
			$table->longText('description');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table(self::TABLE_NAME, function(Blueprint $table) {
			$table->dropColumn('description');
		});
	}
}
