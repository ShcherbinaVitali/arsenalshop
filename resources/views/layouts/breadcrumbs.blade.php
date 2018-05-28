<div class="breadcrumbs-wrap">
	@if(!Request::is('/'))
		<ul class="page-breadcrumbs">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{ route('home') }}">@lang('Главная')</a>
				<i class="fa fa-angle-right"></i>
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
						<i class="fa fa-angle-right"></i>
					@else
						<span>{{ $segments[$i] }}</span>
					@endif
				</li>
			@endfor
		</ul>
	@endif
</div>