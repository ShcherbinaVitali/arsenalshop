<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('admins')->insert([
			'name'     => 'MainAdmin',
			'email'    => 'admin@example.org',
			'password' => bcrypt('EuNtku98j8fj6KNEzb9ZMBak'),
		]);
	}
}
