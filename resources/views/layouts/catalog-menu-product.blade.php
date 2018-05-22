<ul>
	@foreach($products as $product)
		<li class="product-menu-item">
			<a href="/{{ $product->alias }}">{{ $product->title }}</a>
		</li>
	@endforeach
</ul>