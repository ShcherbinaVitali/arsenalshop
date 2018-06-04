@extends('layouts.page')

@section('header.styles')
	@parent
	
	<link rel="stylesheet" href="/css/vendor/xzoom/xzoom.css">
@endsection

@section('header.scripts')
	@parent
	
	<script src="/js/vendor/xzoom/xzoom.min.js"></script>
@endsection

@section('meta-tags')
	<title>{{ $content->meta_title }}</title>
	<meta name="description" content="{{ $content->meta_description }}">
	<meta name="keywords" content="{{ $content->meta_keywords }}">
@endsection

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<hr>
		<div class="container">
			<div class="product-wrap row">
				<div class="product-image-wrap col-md-7">
					<div class="product-image">
						@if( isset($content->images) && count($content->images) > 0 )
							<div class="xzoom-container">
								<img class="xzoom" src="{{ asset("storage/images/products/{$content->id}/{$content->images[0]->name}") }}" xoriginal="{{ asset("storage/images/products/{$content->id}/{$content->images[0]->name}") }}" />
								<div class="xzoom-thumbs">
									@foreach($content->images as $image)
										<a href="{{ asset("storage/images/products/{$content->id}/{$image->name}") }}">
											<img class="xzoom-gallery" width="80" src="{{ asset("storage/images/products/{$content->id}/{$image->name}") }}"  xpreview="{{ asset("storage/images/products/{$content->id}/{$image->name}") }}">
										</a>
									@endforeach
								</div>
							</div>
						@else
							<div class="default-product-img">
								<img src="{{ asset('images/general/default-prod-img.svg') }}" 
									alt="{{ $content->title }}">
							</div>
						@endif
					</div>
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
			$('.xzoom, .xzoom-gallery').xzoom({
				zoomWidth: 300,
				title: false,
				tint: '#333',
				Xoffset: 15,
				adaptive: true
			});
			
		});
	</script>
@endsection

@section('beforeBodyEnd')
	@parent
	<!-- Modal -->
	<div class="modal fade" id="productOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">@lang('Заказ')</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						@lang('Закрыть')
					</button>
					<button type="button" class="btn btn-primary">
						@lang('Отправить')
					</button>
				</div>
			</div>
		</div>
	</div>
@endsection