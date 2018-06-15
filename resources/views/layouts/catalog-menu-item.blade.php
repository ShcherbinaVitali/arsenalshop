<ul>
	@foreach($children as $child)
		@php
			$parentAlias = $parent_alias . '/' . $child->alias;
		@endphp
		<li class="category-menu-item">
			<a href="{{ route('catalog.category', [$parent_alias, $child->alias]) }}">{{ $child->title }}</a>
			
			@if( count($child->subcategories) > 0 )
				@include('layouts.catalog-menu-item',
					['parent_alias' => $parentAlias,'children' => $child->subcategories]
				)
			@endif
			
			@if( count($child->products) > 0 )
				<span class="left-menu-title pl-4">
					@lang('Продукты')
				</span>
				@include('layouts.catalog-menu-product',
					['parent_alias' => $parentAlias, 'products' => $child->products]
				)
			@endif
		</li>
	@endforeach
</ul>