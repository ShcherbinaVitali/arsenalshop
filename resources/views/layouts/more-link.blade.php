@php
	$fullProductUrl = [
		$product->alias
	];
	
	if ( $product->category ) {
		$category         = $product->category;
		$fullProductUrl[] = $category->alias;
		
		$category = \App\Helpers\AppHelper::getParentCategory($category);
		
		if ( $category ) {
			$fullProductUrl[] = $category->alias;
			
			while ( $category->parentCategory ) {
				$category = \App\Helpers\AppHelper::getParentCategory($category);
				$fullProductUrl[] = $category->alias;
			}
		}
	}
	$fullProductUrl = array_reverse($fullProductUrl);
	$fullProductUrl = implode('/', $fullProductUrl);
	
@endphp

<a href="{{ route('catalog.category', $fullProductUrl) }}" class="product-more">
	@lang('Подробнее...')
</a>