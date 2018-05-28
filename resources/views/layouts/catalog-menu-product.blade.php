<ul>
	@foreach($products as $product)
		<li class="product-menu-item">
			<a href="{{ route('catalog.category', [$parent_alias, $product->alias]) }}">{{ $product->title }}</a>
		</li>
	@endforeach
</ul>