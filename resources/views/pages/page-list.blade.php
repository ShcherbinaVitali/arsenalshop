@extends('layouts.page')

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<hr>
		<div class="container">
			<div class="row">
				@if(count($pages) > 0)
					@foreach($pages as $page)
						<div class="col-md-3">
							<a href="{{route('static.page', $page->alias) }}">
								{{ $page->title }}
							</a>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
@endsection