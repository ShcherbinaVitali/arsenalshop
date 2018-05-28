@extends('layouts.page')

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<div class="container">
			<div class="row">
				<div>
					@if($content)
						{{ $content->content }}
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection