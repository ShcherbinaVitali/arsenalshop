@php
	$categories = \App\Helpers\AppHelper::getRootCategories();
	$pages      = \App\Helpers\AppHelper::getPages();
@endphp

<div class="footer-links-wrap">
	<div class="footer-links container">
		<div class="row">
			<div class="col-md-4 footer-links-item">
				<h3>
					@lang('О нас')
				</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium aperiam at beatae deserunt libero nemo nihil officia officiis provident quasi quidem quisquam tempore velit, voluptates! Culpa praesentium quae vel!
				</p>
			</div>
			@if( $categories && count($categories) > 0 )
				<div class="col-md-4 footer-links-item">
					<h3>
						@lang('Категории')
					</h3>
					<ul>
						@foreach($categories as $category)
							<li>
								<a href="{{ route('catalog.category', $category->alias) }}">
									{{ $category->title }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if( $pages && count($pages) > 0 )
				<div class="col-md-4 footer-links-item">
					<h3>
						@lang('Страницы')
					</h3>
					<ul>
						@foreach($pages as $page)
							<li>
								<a href="{{ route('static.page', $page->alias) }}">
									{{ $page->title }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endif
		</div>
	</div>
</div>