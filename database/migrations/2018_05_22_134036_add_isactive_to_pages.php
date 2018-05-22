<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsactiveToPages extends Migration {
	
	const TABLE_NAME           = 'pages';
	const DEFAULT_COLUMN_VALUE = 0;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table(self::TABLE_NAME, function($table) {
			$table
				->smallInteger('is_active')
				->default(self::DEFAULT_COLUMN_VALUE)
			;
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table(self::TABLE_NAME, function($table) {
			$table->dropColumn('is_active');
		});
	}
}
