<ul>
	@foreach($children as $child)
		<li class="category-menu-item">
			<a href="/{{ $child->alias }}">{{ $child->title }}</a>
			@if( count($child->subcategories) > 0 )
				@include('layouts.catalog-menu-item',['children' => $child->subcategories])
			@endif
		</li>
	@endforeach
</ul>