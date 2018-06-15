@extends('layouts.page')

@section('meta-tags')
	<title>{{ $content->title }}</title>
	<meta name="description" content="">
@endsection

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<hr>
		<div class="catalog-list">
			@if( $content )
				<h1 class="category-title">
					{{ $content->title }}
				</h1>
				@if(isset($content->subcategories) && count($content->subcategories) > 0)
					<div class="container">
						<div class="row">
							<div class="subtitle">
								<h4>
									@lang('Подкатегории')
								</h4>
							</div>
							@foreach($content->subcategories as $subcategory)
								<div class="col-md-12 category-item">
									<a href="{{ route('catalog.category',[$content->alias, $subcategory->alias]) }}">
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
								$countOnPage      = 10;
								$countFromSession = session()->get('product-count');
								if ( $countFromSession && $countFromSession > 0 ) {
									$countOnPage = $countFromSession;
								}
							@endphp
								<div class="product-count col-md-12">
									<form action="{{ url("catalog/products-on-page") }}" method="post">
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
							<ul>
								@foreach($products as $product)
									<li class="col-md-12">
										<a href="{{ route('catalog.category', [$content->alias, $product->alias]) }}" class="container">
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
																			@lang('Новинка')
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
																			@lang('Скидка') -{{ $product->discount }}%
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
								@endforeach
							</ul>
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