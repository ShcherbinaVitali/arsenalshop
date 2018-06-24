<?php

use Illuminate\Database\Seeder;

class MainInfoTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('main_info')->insert([
			[
				'title'   => 'owner_email',
				'content' => e('test@example.org')
			],
			[
				'title'   => 'contacts',
				'content' => e('<span class="contact"><span class="contacts-title">Skype:</span><i class="fab fa-skype"></i><strong>test@example</strong></span><span class="contact"><span class="contacts-title">Vel:</span><i class="fa fa-phone"></i>+375 29 <strong>111 11 11</strong></span><span class="contact"><span class="contacts-title">MTS:</span><i class="fa fa-phone"></i>+375 29 <strong>111 11 11</strong></span><span class="contact"><span class="contacts-title">e-mail:</span><i class="far fa-envelope"></i><strong>test@example.org</strong></span>')
			],
			[
				'title'   => 'footer_about',
				'content' => e('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium aperiam at beatae deserunt libero nemo nihil officia officiis provident quasi quidem quisquam tempore velit, voluptates! Culpa praesentium quae vel!</p>')
			]
		]);
	}
}
