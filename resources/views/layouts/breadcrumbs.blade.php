<div class="breadcrumbs-wrap">
	@if(!Request::is('/'))
		<ul class="page-breadcrumbs">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{ route('home') }}">@lang('Главная')</a>
				<span>/</span>
			</li>
			@php
				$segments = Request::segments();
				$path     = '';
			@endphp
			@for($i = 0; $i < count($segments); $i++)
				<li>
					@php
					$path .= $segments[$i] . '/';
					@endphp
					@if($i != count($segments) - 1)
						<a href="/{{ $path }}">{{ $segments[$i] }}</a>
						<span>/</span>
					@else
						<span>{{ $segments[$i] }}</span>
					@endif
				</li>
			@endfor
		</ul>
	@endif
</div>