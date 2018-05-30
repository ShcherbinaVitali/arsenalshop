@extends('pages.panel.admin')

@php
	$backUrl = route('admin.products');
@endphp

@section('content')
	@parent
	
	<div class="panel-products-wrap container">
		@if( isset($product) && $product->id )
			<div class="row">
				<div class="col-md">
					<div class="button-group text-left">
						<a href="{{ $backUrl }}" class="btn btn-secondary">
							@lang('Назад')
						</a>
						<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">
							@lang('Редактировать')
						</a>
						<a href="{{ route('admin.products.delete', $product->id) }}" class="btn btn-danger">
							@lang('Удалить')
						</a>
					</div>
					<div class="panel-product-content">
						<div class="product-info">
							<div>
								<h3>
									@lang('Основная информация')
								</h3>
								<div>
									<strong>ID:</strong>
									<span>
										{{ $product->id }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Заголовок'):
									</strong>
									<span>
										{{ $product->title }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Ссылка'):
									</strong>
									<span>
										{{ $product->alias }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Родительская категория'):
									</strong>
									<span>
										{{ $parent_category }}
									</span>
								</div>
								<div>
									@if( $product->is_active )
										<strong>
											@lang('Товар активирован')
										</strong>
									@else
										<strong>
											@lang('Товар не активирован')
										</strong>
									@endif
								</div>
								<hr>
								@if( $product->price )
									<div>
										<strong>
											@lang('Цена'):
										</strong>
										<span>
											{{ $product->price }}
										</span>
									</div>
								@endif
								@if( $product->count )
									<div>
										<strong>
											@lang('Количество'):
										</strong>
										<span>
											{{ $product->count }}
										</span>
									</div>
								@endif
								@if( $product->new == 1 )
									<div>
										<strong>
											@lang('Новинка')
										</strong>
									</div>
								@endif
								@if( $product->bestseller == 1 )
									<div>
										<strong>
											@lang('Бестселлер')
										</strong>
									</div>
								@endif
								@if( $product->discount )
									<div>
										<strong>
											@lang('Скидка'):
										</strong>
										<span>
										{{ $product->discount }}%
									</span>
									</div>
								@endif
							</div>
						</div>
						<hr>
						<div class="meta-info">
							<h3>@lang('Meta инфо')</h3>
							<p>
								<strong>
									@lang('Meta title'):
								</strong>
								<span>
									{{ $product->meta_title }}
								</span>
							</p>
							<p>
								<strong>
									@lang('Meta Keywords'):
								</strong>
								<span>
									{{ $product->meta_keywords }}
								</span>
							</p>
							<p>
								<strong>
									@lang('Meta Description'):
								</strong>
								<span>
									{{ $product->meta_description }}
								</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection