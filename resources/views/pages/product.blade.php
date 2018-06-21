@extends('layouts.page')

@section('header.styles')
	<link rel="stylesheet" href="/css/vendor/slick/slick.css">
	<link rel="stylesheet" href="/css/vendor/slick/slick-theme.css">
	
	@parent
@endsection

@section('meta-tags')
	<title>{{ $content->meta_title }}</title>
	<meta name="description" content="{{ $content->meta_description }}">
	<meta name="keywords" content="{{ $content->meta_keywords }}">
@endsection

@php
	$creds = \App\Helpers\AppHelper::getCaptchaCreds();
@endphp

@section('content')
	<div class="content col-sm-9 col-md-9 col-lg-9">
		<hr>
		<div class="container">
			<div class="product-wrap row clearfix">
				<div class="product-image-wrap col-md-7">
					@if( isset($content->images) && count($content->images) > 0 )
						<div id="product-slider">
							@foreach($content->images as $image)
								<div class="product-view">
									<img src="{{ asset("storage/images/products/{$content->id}/{$image->name}") }}">
								</div>
							@endforeach
						</div>
						<div id="product-view">
							@foreach($content->images as $image)
								<div class="product-view">
									<img src="{{ asset("storage/images/products/{$content->id}/{$image->name}") }}">
								</div>
							@endforeach
						</div>
					@else
						<div class="default-product-img">
							<img src="{{ asset('images/general/default-prod-img.svg') }}" 
								alt="{{ $content->title }}">
						</div>
					@endif
				</div>
				<div class="info-block col-md-5">
					<div class="info-panel">
						<div class="page-title">
							<h1>{{ $content->title }}</h1>
						</div>
						@if( $content->new || $content->bestseller || $content->discount )
							<div class="additional-info container">
								<div class="row text-center">
									@if( $content->new )
										<div class="info-label col-md-4 new">
											<span class="align-middle">
												@lang('Новинка')
											</span>
										</div>
									@endif
									@if( $content->bestseller )
										<div class="info-label col-md-4 bestseller">
											<span class="align-middle">
												@lang('Хит')
											</span>
										</div>
									@endif
									@if( $content->discount )
										<div class="info-label col-md-4 discount">
											<span class="align-middle">
												@lang('Скидка') -{{ $content->discount }}%
											</span>
										</div>
									@endif
								</div>
							</div>
						@endif
						@if( $content->price )
							<div class="product-price">
								<strong>
									@if( $content->discount )
										<s class="old-price">{{ $content->price }} @lang('BYN')</s>
										<span class="discounted-price">{{ $content->price - ( $content->price / 100 * $content->discount ) }}</span>
									@else
										<span>{{ $content->price }}</span>
									@endif
								</strong>
								<span class="@if ($content->discount) discounted-currency @endif">@lang('BYN')</span>
							</div>
						@endif
						<div class="product-count">
							@if( $content->count && $content->count > 0 )
								<strong>
									@lang('Количество'):
								</strong>
								<span>
									{{ $content->count }}
								</span>
							@else
								<span>@lang('Под заказ')</span>
							@endif
						</div>
						<div class="product-btn">
							<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#productOrderModal">
								@lang('Заказать')
							</button>
						</div>
					</div>
				</div>
				<div class="product-description col-md">
					<h3>
						<span>@lang('Описание')</span>
					</h3>
					<p>
						{!! html_entity_decode($content->description) !!}
					</p>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#product-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
				speed: 300,
				dots: false,
				arrows: true,
				fade: true,
				asNavFor: '#product-view',
			});
			
			$('#product-view').slick({
				slidesToShow: 2,
				slidesToScroll: 1,
				arrows: true,
				centerMode: true,
				focusOnSelect: true,
				asNavFor: '#product-slider',
			});
			
			$('#product-slider .product-view').zoom();
		});
	</script>
@endsection

@section('beforeBodyEnd')
	@parent
	<!-- Modal -->
	<div class="modal fade" id="productOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="{{ url("order-product") }}" method="post" id="order_product">
					@csrf
					
					<div class="modal-header">
						<h5 class="modal-title">@lang('Заказ')</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<fieldset class="form-group">
							<label for="name">@lang('Ваше имя')</label>
							<input type="hidden" name="product_id" value="{{ $content->id }}">
							<input type="text" name="name" id="name" class="form-control" required minlength="3" maxlength="150">
						</fieldset>
						<fieldset class="form-group">
							<label for="phone">@lang('Ваш номер')</label>
							<input type="text" id="phone" name="phone" class="form-control" required maxlength="20">
							<small id="senderHelp" class="form-text text-muted">@lang('Пример: +375 ## ### ## ## или сокращенно с кодом оператора')</small>
						</fieldset>
						<fieldset class="form-group">
							<p>@lang('Вы заказываете'): <strong>{{ $content->title }}</strong></p>
							<label for="topic">@lang('Количество')</label>
							<input name="count" id="count" class="form-control" type="number" min="1" step="1" value="1">
						</fieldset>
						@if( $creds && is_array($creds) )
							<fieldset class="form-group">
								<div class="g-recaptcha" data-sitekey="{{ $creds['sitekey'] }}" style="transform:scale(0.9);-webkit-transform:scale(0.9);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</fieldset>
						@endif
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							@lang('Закрыть')
						</button>
						<button type="submit" class="btn btn-primary">
							@lang('Отправить')
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="/js/vendor/jquery.zoom.min.js"></script>
	<script src="/js/vendor/slick/slick.min.js"></script>
@endsection