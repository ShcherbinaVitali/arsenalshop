<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUniquePageAliasToPages extends Migration {
	const TABLE_NAME = 'pages';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table(self::TABLE_NAME, function ($table) {
			$table
				->unique('alias')
				//->change()
			;
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table(self::TABLE_NAME, function ($table) {
			$table
				->dropUnique('alias')
				//->change()
			;
		});
	}
}
