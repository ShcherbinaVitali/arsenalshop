@extends('layouts.page')

@section('meta-tags')
	<title>{{ $content->meta_title }}</title>
	<meta name="description" content="{{ $content->meta_description }}">
	<meta name="keywords" content="{{ $content->meta_keywords }}">
@endsection

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<div class="container">
			<hr>
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