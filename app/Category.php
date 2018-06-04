<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	
	protected $fillable = [
		'title',
		'alias',
		'parent_id',
		'is_active'
	];
	
	protected $table = 'categories';
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function subcategories() {
		return $this
			->hasMany(Category::class, 'parent_id', 'id')
			->where('categories.is_active', '=', 1)
		;
	}
	
	/**
	 * 
	 */
	public function products() {
		return $this
			->hasMany(Product::class, 'category_id', 'id')
			->where('products.is_active', '=', 1)
		;
	}
}
