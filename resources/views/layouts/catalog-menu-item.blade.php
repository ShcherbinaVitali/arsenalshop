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
			
		</li>
	@endforeach
</ul>