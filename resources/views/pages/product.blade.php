@extends('layouts.page')

@section('meta-tags')
	<title>{{ $content->meta_title }}</title>
	<meta name="description" content="{{ $content->meta_description }}">
	<meta name="keywords" content="{{ $content->meta_keywords }}">
@endsection

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<div class="container">
			<div class="product-wrap">
				<div class="page-title">
					<h1>{{ $content->title }}</h1>
				</div>
				<div class="product-price">
					{{ $content->price }}
					<span>@lang('BYR')</span>
				</div>
			</div>
		</div>
	</div>
@endsection