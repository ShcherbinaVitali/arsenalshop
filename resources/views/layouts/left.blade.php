@php
	$catWithProducts = \App\Helpers\AppHelper::getCategoriesWithProducts();
@endphp

@if( count($catWithProducts) > 0 )
	<div class="left-wrap col-sm-4 col-md-4 col-lg-4">
		<div class="left-menu">
			left
			<div class="menu">
				menu
				<ul>
					@foreach($catWithProducts as $item)
						<li class="category-menu-item">
							<a href="/{{ $item->alias }}">{{ $item->title }}</a>
							@if( count($item->subcategories) > 0 )
								@include('layouts.catalog-menu-item', ['children' => $item->subcategories])
							@endif
							
							@if( count($item->products) > 0 )
								@include('layouts.catalog-menu-product', ['products' => $item->products])
							@endif
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endif