@extends('layouts.page')

@section('meta-tags')
	@if( isset($content) )
		<title>{{ $content->meta_title }}</title>
		
		<meta name="description" content="{{ $content->meta_description }}">
		<meta name="keywords" content="{{ $content->meta_keywords }}">
	@endif
	
	<meta name="robots" content="index, follow, all">
@endsection

@section('content')
	<div class="content col-sm-9 col-md-9 col-lg-9 home-page">
		<div class="home-page-content">
			@if( isset($content) )
				{!! html_entity_decode($content->content) !!}
			@else
				@lang('Нет контента для главной страницы')
			@endif
		</div>
	</div>
@endsection