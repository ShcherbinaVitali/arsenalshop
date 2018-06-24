@extends('layouts.page')

@section('meta-tags')
	@if( isset($content) )
		<title>{{ $content->meta_title }}</title>
		
		<meta name="description" content="{{ $content->meta_description }}">
		<meta name="keywords" content="{{ $content->meta_keywords }}">
	@endif
	
	<meta name="robots" content="index, follow, all">
@endsection

@php
	$sliderConfig = config()->get('additional.main_slider');
	if ( $sliderConfig['show'] ) {
		$directory = 'images/general/' . $sliderConfig['path'];
		$images    = \Illuminate\Support\Facades\File::allFiles($directory);
	}
	
	$bestsellers = \App\Helpers\AppHelper::getBestSellerProducts();
@endphp

@section('header.styles')
	<link rel="stylesheet" href="/css/vendor/owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet" href="/css/vendor/owlcarousel/owl.theme.default.min.css">
	
	@parent
@endsection

@section('header.scripts')
	@parent
	
@endsection

@section('content')
	<div class="content col-sm-9 col-md-9 col-lg-9 home-page">
		@if( $sliderConfig['show'] )
			<div class="slider-wrap">
				<div class="owl-carousel">
					@foreach($images as $image)
						<div>
							<img src="{!! (string)$image !!}" style="height: 300px;">
						</div>
					@endforeach
				</div>
			</div>
			<script>
				$(document).ready(function() {
					$(document).ready(function(){
						$('.owl-carousel').owlCarousel({
							loop:true,
							autoHeight: true,
							items:1,
							nav:true,
							dots: true,
							navText: ' ',
							autoplay:true,
							autoplayTimeout:5000,
							autoplayHoverPause: true,
							smartSpeed:2000,
						});
					});
				});
			</script>
		@endif
	</div>
@endsection
@section('content-after')
	<div class="home-page-content">
		@if( $bestsellers && count($bestsellers) > 0 )
			<div class="bestsellers-wrap">
				<div class="bestsellers-wrap-title">
					<span>
						@lang('Хиты')
					</span>
				</div>
				<div class="container">
					<div class="row">
						@foreach($bestsellers as $bestseller)
							<div class="col-6 col-sm-3 col-md-3 col-lg-3 bestseller-item">
								@php
									$bestsellerUrl = \App\Helpers\AppHelper::getFullUrlForItem($bestseller);
								@endphp
								<a href="{{ route('catalog.category', $bestsellerUrl) }}">
									@if( isset($bestseller->images) && count($bestseller->images) > 0 )
										<img src="{{ asset("storage/images/products/{$bestseller->id}/{$bestseller->images[0]->name}") }}">
									@else
										<img src="{{ asset('images/general/default-prod-img.svg') }}"
											 alt="{{ $bestseller->title }}">
									@endif
									<div class="bestseller-title">
										<h4>{{ $bestseller->title }}</h4>
									</div>
								</a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		@endif
		@if( isset($content) )
			<div class="content-after">
				{!! html_entity_decode($content->content) !!}
			</div>
		@else
			@lang('Нет контента для главной страницы')
		@endif
	</div>
@endsection
@section('beforeBodyEnd')
	@parent
	
	<script src="/js/vendor/owlcarousel/owl.carousel.min.js"></script>
@endsection