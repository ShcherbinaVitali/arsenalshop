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
		<hr>
		
		<div class="row ml-0 mr-0">
			@if( isset($list) && count($list) > 0 )
				@foreach($list as $item)
					<div class="col-md-4 clearfix admin-list-item">
						<a href="{{ route($view_route, $item->id) }}">
							{{ $item->title }}
						</a>
						<a href="{{ route($delete_route, $item->id) }}" class="additional-links float-right">
							<i class="far fa-trash-alt"></i>
						</a>
						<a href="{{ route($edit_route, $item->id) }}" class="additional-links float-right">
							<i class="fas fa-pencil-alt"></i>
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