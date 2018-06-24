@php
	$categories = \App\Helpers\AppHelper::getRootCategories();
	$pages      = \App\Helpers\AppHelper::getPages();
	$aboutInfo  = \App\Helpers\AppHelper::getFromInfoByTitle('footer_about');
@endphp

<div class="footer-links-wrap">
	<div class="footer-links container">
		<div class="row">
			@if( $aboutInfo )
				<div class="col-12 col-md-4 col-lg-4 footer-links-item">
					<h3>
						@lang('О нас')
					</h3>
					{!! html_entity_decode($aboutInfo->content) !!}
				</div>
			@endif
			@if( $categories && count($categories) > 0 )
				<div class="col-6 col-md-4 col-lg-4 footer-links-item">
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
				<div class="col-6 col-md-4 col-lg-4 footer-links-item">
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