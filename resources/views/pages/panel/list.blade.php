@extends('pages.panel.admin')

@section('content')
	@parent
	
	<div class="admin-list-wrap container">
		<div>
			<a href="{{ route($btn_route) }}" class="btn btn-primary">
				{{ $btn_title }}
			</a>
		</div>
		<h2>{{ $title }}</h2>
		
		<div class="row">
			@if( isset($list) && count($list) > 0 )
				@foreach($list as $item)
					<div class="col-md-4">
						<a href="{{ route($route_name, $item->id) }}">
							{{ $item->title }}
						</a>
					</div>
				@endforeach
			@else
				<p class="no-items">
					@lang('Нет содержимого')
				</p>
			@endif
		</div>
	</div>
@endsection