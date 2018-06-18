@php
	$catWithProducts = \App\Helpers\AppHelper::getCategoriesWithProducts();
@endphp

@if( count($catWithProducts) > 0 )
	<div class="left-wrap col-sm-3 col-md-3 col-lg-3">
		<div class="left-menu">
			<div class="catalog-menu-title">
				<span>@lang('Каталог')</span>
			</div>
			<div class="menu">
				<ul>
					@foreach($catWithProducts as $item)
						<li class="category-menu-item 
							@php
								$categoryActive = session()->get('category.active');
								if (isset($categoryActive) && $categoryActive == $item->alias) {
									echo 'item-active';
								}
							@endphp
						">
							<a href="{{ route('catalog.category', $item->alias) }}">
								{{ $item->title }}
							</a>
							
							@if( count($item->subcategories) > 0 )
								<span class="left-menu-title">
									@lang('Подкатегории')
								</span>
								@include('layouts.catalog-menu-item',
									['parent_alias' => $item->alias, 'children' => $item->subcategories]
								)
							@endif
							
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endif

@section('beforeBodyEnd')
	@parent
	<script src="/js/main.js"></script>
@endsection