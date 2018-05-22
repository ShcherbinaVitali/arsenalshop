@php
	$pages = \App\Helpers\AppHelper::getPages();
@endphp

@if( count($pages) > 0 )
	<div class="top-menu-wrap">
		<div class="container">
			<div class="">
				<ul class="top-menu mx-auto">
					@foreach($pages as $page)
						<li class="top-menu-item">
							<a href="/{{ $page->alias }}">
								{{ $page->title }}
							</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endif