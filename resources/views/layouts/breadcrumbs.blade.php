<div class="breadcrumbs-wrap">
	@if( !Request::is('/') )
		<ul class="page-breadcrumbs">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{ route('home') }}">@lang('Главная')</a>
				<span>/</span>
			</li>
			@php
				$segments = Request::segments();
				$path     = '';
				
				if ( $segments[0] === 'catalog' && count($segments) > 1 ) {
					$item = $segments[count($segments) - 1];
					
					$model = \App\Product::where('alias', '=', $item)->get()->first();
					if ( !$model ) {
						$model = \App\Category::where('alias', '=', $item)->get()->first();
					}
					
					$segments = \App\Helpers\AppHelper::getBreadcrumbsByModel($model);
					array_unshift($segments, ['alias' => 'catalog', 'title' => 'Каталог']);
				}
				elseif ($segments[0] === 'pages' && count($segments) > 1) {
					$segments[0] = 'Страницы';
				}
			@endphp
			@if( Request::segment(1) === 'catalog' && count(Request::segments()) > 1 )
				@for($i = 0; $i < count($segments); $i++)
					<li>
						@php
							$path .= $segments[$i]['alias'] . '/';
						@endphp
						@if($i != count($segments) - 1)
							<a href="/{{ $path }}">{{ $segments[$i]['title'] }}</a>
							<span>/</span>
						@else
							<span>{{ $segments[$i]['title'] }}</span>
						@endif
					</li>
				@endfor
			@else
				@for($i = 0; $i < count($segments); $i++)
					<li>
						@php
							$path .= $segments[$i] . '/';
						@endphp
						@if($i != count($segments) - 1)
							<a href="/{{ $path }}">{{ $segments[$i] }}</a>
							<span>/</span>
						@else
							@switch($segments[$i])
								@case('catalog')
									<span>@lang('Каталог')</span>
								@break
								@case('search')
									<span>@lang('Поиск')</span>
								@break
								@case('pages')
									<span>@lang('Страницы')</span>
								@break
								@default
									<span>{{ $segments[$i] }}</span>
								@break
							@endswitch
						@endif
					</li>
				@endfor
			@endif
		</ul>
	@endif
</div>