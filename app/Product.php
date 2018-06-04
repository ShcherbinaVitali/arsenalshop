<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	protected $fillable = [
		'title',
		'meta_title',
		'meta_keywords',
		'meta_description',
		'category_id',
		'price',
		'count',
		'new',
		'bestseller',
		'alias',
		'is_active',
		'discount',
		'description'
	];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category() {
		return $this
			->belongsTo(Category::class, 'category_id');
	}
	
	public function images() {
		return $this
			->hasMany(ProductImage::class, 'product_id', 'id');
	}
}
