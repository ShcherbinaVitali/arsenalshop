<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model {
	protected $table = 'main_info';
	protected $fillable = [
		'title',
		'content'
	];
}
