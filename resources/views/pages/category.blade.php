@extends('layouts.page')

@section('meta-tags')
	<title>{{ $content->title }}</title>
	<meta name="description" content="">
@endsection

@section('content')
	<div class="content col-sm-9 col-md-9 col-lg-9">
		<hr>
		<div class="catalog-list">
			@if( $content )
				<h1 class="category-title">
					{{ $content->title }}
				</h1>
				@if( isset($content->subcategories) && count($content->subcategories) > 0 )
					<div class="container">
						<div class="row">
							<div class="subtitle">
								<h4>
									@lang('Подкатегории')
								</h4>
							</div>
							@foreach($content->subcategories as $subcategory)
								@php
									$subcategoryUrl = \App\Helpers\AppHelper::getFullUrlForItem($subcategory);
								@endphp
								<div class="col-md-12 category-item">
									<a href="{{ route('catalog.category', $subcategoryUrl) }}">
										{{ $subcategory->title }}
									</a>
								</div>
							@endforeach
						</div>
					</div>
				@endif
				@if(isset($content->products) && count($content->products) > 0)
					<div class="container product-list">
						<div class="row">
							<div class="subtitle">
								<h4>
									@lang('Продукты')
								</h4>
							</div>
							@php
								$countOnPageArr   = \App\Helpers\AppHelper::PRODUCT_ON_PAGE_ARR;
								$countOnPage      = \App\Helpers\AppHelper::DEFAULT_PRODUCT_COUNT;
								$countFromSession = session()->get('product-count');
								if ( $countFromSession && $countFromSession > 0 ) {
									$countOnPage = $countFromSession;
								}
							@endphp
								<div class="product-count col-md-12">
									<form action="{{ url("catalog/view-products") }}" method="post" class="grid-form">
										@csrf
										<div class="text-left d-inline">
											<input type="hidden" name="view_products" value="grid">
											<button type="submit">
												<i class="fas fa-th-large"></i>
											</button>
										</div>
									</form>
									<form action="{{ url("catalog/view-products") }}" method="post" class="list-form">
										@csrf
										<div class="text-left d-inline">
											<input type="hidden" name="view_products" value="list">
											<button type="submit">
												<i class="fas fa-th-list"></i>
											</button>
										</div>
									</form>
									<form action="{{ url("catalog/products-on-page") }}" method="post" class="count_on_page">
										@csrf
										<div class="form-group text-right">
											<label for="#product-count-on-page">@lang('Количество продуктов')</label>
											<select id="product-count-on-page" class="product-count-on-page form-control" name="count">
												@foreach($countOnPageArr as $countProduct)
													<option value="{{ $countProduct }}"
															@if($countProduct == $countOnPage)
															selected
															@endif>
														{{ $countProduct }}
													</option>
												@endforeach
											</select>
										</div>
									</form>
								</div>
							@php
								$products = $content->products()->paginate($countOnPage);
							@endphp
							<script>
								$(document).ready(function () {
									$('.product-count-on-page').on('change', function () {
										$(this).closest('form').submit();
									});
								});
							</script>
							<div class="col-md-12 container products-container">
								<ul class="row">
									@foreach($products as $product)
										@if( !session()->get('product-list') )
											<li class="col-12 col-sm-3 col-md-3 col-lg-3 product-grid-item">
												@php
													$productUrl = \App\Helpers\AppHelper::getFullUrlForItem($product);
												@endphp
												<a href="{{ route('catalog.category', $productUrl) }}" class="container">
													<div class="row">
														@if( count($product->images) > 0 )
															<div class="preview-image col-md-12">
																@php
																	$previewImg = $product->images[0];
																@endphp
																<img src="{{ asset("storage/images/products/{$product->id}/{$previewImg->name}") }}"
																	 alt="{{ $product->title }}">
															</div>
														@else
															<div class="preview-image col-md-12">
																<img src="{{ asset('images/general/default-prod-img.svg') }}"
																	 alt="{{ $product->title }}">
															</div>
														@endif
														<div class="col-md-12">
															<div class="product-title">
																<strong>
																	{{ $product->title }}
																</strong>
															</div>
															@if( $product->new || $product->bestseller || $product->discount )
																<div class="additional-info container">
																	<div class="row text-center">
																		@if( $product->new )
																			<div class="info-label col-md-4 new">
																		<span class="align-middle">
																			@lang('New')
																		</span>
																			</div>
																		@endif
																		@if( $product->bestseller )
																			<div class="info-label col-md-4 bestseller">
																		<span class="align-middle">
																			@lang('Хит')
																		</span>
																			</div>
																		@endif
																		@if( $product->discount )
																			<div class="info-label col-md-4 discount">
																		<span class="align-middle">
																			-{{ $product->discount }}%
																		</span>
																			</div>
																		@endif
																	</div>
																</div>
															@endif
															<div class="product-price">
																<strong>
																	@if( $product->discount )
																		<s class="old-price">{{ $product->price }} @lang('BYN')</s>
																		<span class="discounted-price">{{ $product->price - ( $product->price / 100 * $product->discount ) }}</span>
																	@else
																		<span>{{ $product->price }}</span>
																	@endif
																</strong>
																<span class="@if ($product->discount) discounted-currency @endif">@lang('BYN')</span>
															</div>
														</div>
													</div>
												</a>
											</li>
										@else
											<li class="col-12 col-md-12 product-list-item">
												@php
													$productUrl = \App\Helpers\AppHelper::getFullUrlForItem($product);
												@endphp
												<a href="{{ route('catalog.category', $productUrl) }}" class="container">
													<div class="row">
														@if( count($product->images) > 0 )
															<div class="preview-image col-md-4">
																@php
																	$previewImg = $product->images[0];
																@endphp
																<img src="{{ asset("storage/images/products/{$product->id}/{$previewImg->name}") }}"
																	 alt="{{ $product->title }}">
															</div>
														@else
															<div class="preview-image col-md-4">
																<img src="{{ asset('images/general/default-prod-img.svg') }}"
																	 alt="{{ $product->title }}">
															</div>
														@endif
														<div class="col-md-8">
															<div class="product-title">
																<strong>
																	{{ $product->title }}
																</strong>
															</div>
															@if( $product->new || $product->bestseller || $product->discount )
																<div class="additional-info container">
																	<div class="row text-center">
																		@if( $product->new )
																			<div class="info-label col-md-4 new">
																		<span class="align-middle">
																			@lang('New')
																		</span>
																			</div>
																		@endif
																		@if( $product->bestseller )
																			<div class="info-label col-md-4 bestseller">
																		<span class="align-middle">
																			@lang('Хит')
																		</span>
																			</div>
																		@endif
																		@if( $product->discount )
																			<div class="info-label col-md-4 discount">
																		<span class="align-middle">
																			-{{ $product->discount }}%
																		</span>
																			</div>
																		@endif
																	</div>
																</div>
															@endif
															<div class="product-price">
																<strong>
																	@if( $product->discount )
																		<s class="old-price">{{ $product->price }} @lang('BYN')</s>
																		<span class="discounted-price">{{ $product->price - ( $product->price / 100 * $product->discount ) }}</span>
																	@else
																		<span>{{ $product->price }}</span>
																	@endif
																</strong>
																<span class="@if ($product->discount) discounted-currency @endif">@lang('BYN')</span>
															</div>
														</div>
													</div>
												</a>
											</li>
										@endif
									@endforeach
								</ul>
							</div>
							<div class="pagination-wrap">
								<nav aria-label="Page navigation">
									{{ $products->links() }}
								</nav>
							</div>
						</div>
					</div>
				@else
					<div class="no-products">
						<h4>
							@lang('В данной категории нет товаров')
						</h4>
					</div>
				@endif
			@endif
		</div>
	</div>
@endsection