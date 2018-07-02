@extends('layouts.page')

@section('meta-tags')
	<title>{{ $content->meta_title }}</title>
	<meta name="description" content="{{ $content->meta_description }}">
	<meta name="keywords" content="{{ $content->meta_keywords }}">
@endsection

@section('content')
	<div class="content col-sm-9 col-md-9 col-lg-9">
		<div class="container">
			<hr>
			<div class="row">
				<div class="s-page-title">
					<h1>{{ $content->title }}</h1>
				</div>
				<div class="static-page-content">
					@if($content)
						{!! html_entity_decode($content->content) !!}
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection