<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('meta_title', 65)->nullable(true);
			$table->string('meta_keywords')->nullable(true);
			$table->string('meta_description', 160)->nullable(true);
			$table->integer('order')->nullable(true);
			$table->string('alias');
			$table->longText('content');
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('pages');
	}
}
