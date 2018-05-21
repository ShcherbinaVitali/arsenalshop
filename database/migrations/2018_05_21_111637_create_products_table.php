<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {
	
	const TABLE_NAME              = 'products';
	const DEFAULT_CATEGORY_ID     = 0;
	const DEFAULT_NEW_FLAG        = false;
	const DEFAULT_BESTSELLER_FLAG = false;
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create(self::TABLE_NAME, function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('meta_title', 65)->nullable(true);
			$table->string('meta_keywords')->nullable(true);
			$table->string('meta_description', 160)->nullable(true);
			$table->integer('category_id')->default(self::DEFAULT_CATEGORY_ID);
			$table->float('price', 8, 2)->nullable(true);
			$table->integer('count')->nullable(true);
			$table->boolean('new')->default(self::DEFAULT_NEW_FLAG);
			$table->boolean('bestseller')->default(self::DEFAULT_BESTSELLER_FLAG);
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
