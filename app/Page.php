<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {
	protected $fillable = [
		'title',
		'meta_title',
		'meta_keywords',
		'meta_description',
		'alias',
		'content',
		'is_active',
		'order'
	];
}
