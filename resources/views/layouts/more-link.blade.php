@php
	$fullProductUrl = \App\Helpers\AppHelper::getFullUrlForItem($product);
	
@endphp

<a href="{{ route('catalog.category', $fullProductUrl) }}" class="product-more">
	@lang('Подробнее...')
</a>