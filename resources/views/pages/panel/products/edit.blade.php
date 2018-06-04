@extends('pages.panel.admin')

@php
	$backUrl   = isset($product->id) ? route('admin.products.product', $product->id) : route('admin.products');
	$pageTitle = isset($product->id) ? 'Редактирование Товара' : 'Создание Товара';
@endphp

@section('content')
	@parent
	
	<div class="panel-products-wrap container">
		@if( isset($product) && $product->id )
			<div class="row">
				<div class="col-md">
					<h2>{{ $pageTitle }}</h2>
					<form action="{{ route('admin.products.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-product-content">
							<div class="product-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<strong>ID:</strong>
										<span>
											{{ $product->id }}
										</span>
										<input type="hidden" name="id" value="{{ $product->id }}">
									</div>
									<div class="form-group">
										<strong>
											@lang('Заголовок товара'):
										</strong>
										<p>
											<input type="text" name="title" value="{{ $product->title }}" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Ссылка товара'):
										</strong>
										<p>
											<input type="text" name="alias" value="{{ $product->alias }}" required class="form-control">
											<span class="note">
												@lang('Должна быть уникальной, писать латиницей')
											</span>
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Родительская категория'):
										</strong>
										<p>
											<select name="category_id" class="form-control">
												@foreach($category_list as $item)
													<option value="{{ $item->id }}"
														@if( $product->category_id == $item->id )
															 selected
														@endif
													>
														{{ $item->title }}
													</option>
												@endforeach
											</select>
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Товар активирован'):
										</strong>
										<p>
											<input type="checkbox" name="is_active" value="1" class="form-check"
												@if($product->is_active == 1)
													 checked
												@endif
											>
										</p>
									</div>
									<div class="form-group image-container">
										<strong>
											@lang('Изображения товара'):
										</strong>
										<i class="fas fa-plus-circle" id="add-input"></i>
										<div class="img-preview container">
											@if( $product->images && count($product->images) > 0 )
												<div class="row">
													@foreach($product->images as $image)
														<div class="img-item col-md-2">
															<div class="loading"></div>
															<img src="{{ asset("storage/images/products/{$image->product_id}/{$image->name}") }}" alt="">
															<i class="far fa-times-circle remove-product-image"></i>
														</div>
													@endforeach
												</div>
											@endif
										</div>
										<p class="form-control">
											<input type="file" name="product_image[]" class="add-image" multiple>
										</p>
									</div>
								</div>
							</div>
							<div class="meta-info">
								<h3>@lang('Meta инфо')</h3>
								<div class="form-group">
									<strong>
										@lang('Meta title'):
									</strong>
									<p>
										<input type="text" name="meta_title" value="{{ $product->meta_title }}" required class="form-control">
										<span class="note">
											@lang('максимум 65 символов')
										</span>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Meta Keywords'):
									</strong>
									<p>
										<textarea name="meta_keywords" id="" cols="30" rows="4" class="form-control">{{ $product->meta_keywords }}</textarea>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Meta Description'):
									</strong>
									<p>
										<textarea name="meta_description" id="" cols="30" rows="4" required class="form-control">{{ $product->meta_description }}</textarea>
										<span class="note">
											@lang('максимум 160 символов')
										</span>
									</p>
								</div>
							</div>
							<hr>
							<div class="additional-info">
								<h3>@lang('Дополнительно')</h3>
								<div class="form-group">
									<strong>
										@lang('Новинка'):
									</strong>
									<p>
										<input type="checkbox" name="new" value="1" class="form-check" 
											@if( $product->new == 1 )
												 checked
											@endif
										>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Бестселлер'):
									</strong>
									<p>
										<input type="checkbox" name="bestseller" value="1" class="form-check" 
											@if( $product->bestseller == 1 )
												 checked
											@endif
										>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Цена'):
									</strong>
									<p>
										<input type="text" name="price" class="form-control"
											@if( $product->price )
												 value="{{ $product->price }}"
											@endif
										>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Количество'):
									</strong>
									<p>
										<input type="text" name="count" class="form-control"
											@if( $product->count )
												 value="{{ $product->count }}"
											@endif
										>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Скидка') (%):
									</strong>
									<p>
										<input type="text" name="discount" class="form-control"
											@if( $product->discount )
												 value="{{ $product->discount }}"
											@endif
										>
									</p>
								</div>
							</div>
						</div>
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
					</form>
				</div>
			</div>
		@else
			<div class="row">
				<div class="col-md">
					<h2>{{ $pageTitle }}</h2>
					<form action="{{ route('admin.products.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-product-content">
							<div class="product-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<input type="hidden" name="id" value="">
									</div>
									<div class="form-group">
										<strong>
											@lang('Заголовок товара'):
										</strong>
										<p>
											<input type="text" name="title" value="" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Ссылка товара'):
										</strong>
										<p>
											<input type="text" name="alias" value="" required class="form-control">
											<span class="note">
												@lang('Должна быть уникальной, писать латиницей')
											</span>
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Родительская категория'):
										</strong>
										<p>
											<select name="category_id" class="form-control" required>
												@foreach($category_list as $item)
													<option value="{{ $item->id }}">
														{{ $item->title }}
													</option>
												@endforeach
											</select>
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Описание товара'):
										</strong>
										<p>
											<textarea name="description" id="" cols="30" rows="4" class="form-control" required></textarea>
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Товар активирован'):
										</strong>
										<p>
											<input type="checkbox" name="is_active" value="1" class="form-check">
										</p>
									</div>
									<div class="form-group image-container">
										<strong>
											@lang('Изображения товара'):
										</strong>
										<i class="fas fa-plus-circle" id="add-input"></i>
										<p class="form-control">
											<input type="file" name="product_image[]" class="add-image" multiple>
										</p>
									</div>
								</div>
							</div>
							<div class="meta-info">
								<h3>@lang('Meta инфо')</h3>
								<div class="form-group">
									<strong>
										@lang('Meta title'):
									</strong>
									<p>
										<input type="text" name="meta_title" value="" required class="form-control">
										<span class="note">
											@lang('максимум 65 символов')
										</span>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Meta Keywords'):
									</strong>
									<p>
										<textarea name="meta_keywords" id="" cols="30" rows="4" class="form-control"></textarea>
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Meta Description'):
									</strong>
									<p>
										<textarea name="meta_description" id="" cols="30" rows="4" required class="form-control"></textarea>
										<span class="note">
											@lang('максимум 160 символов')
										</span>
									</p>
								</div>
							</div>
							<hr>
							<div class="additional-info">
								<h3>@lang('Дополнительно')</h3>
								<div class="form-group">
									<strong>
										@lang('Новинка'):
									</strong>
									<p>
										<input type="checkbox" name="new" value="1" class="form-check">
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Бестселлер'):
									</strong>
									<p>
										<input type="checkbox" name="bestseller" value="1" class="form-check">
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Цена'):
									</strong>
									<p>
										<input type="text" name="price" class="form-control" value="">
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Количество'):
									</strong>
									<p>
										<input type="text" name="count" class="form-control">
									</p>
								</div>
								<div class="form-group">
									<strong>
										@lang('Скидка') (%):
									</strong>
									<p>
										<input type="text" name="discount" class="form-control">
									</p>
								</div>
							</div>
						</div>
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
					</form>
				</div>
			</div>
		@endif
		<script>
			var parseImgSrc = function (src) {
				var arr  = src.split('/');
				var id   = arr[arr.length - 2];
				var name = arr[arr.length - 1];
				
				return {
					id: id,
					name: name
				}
			};
			
			$('.remove-product-image').click(function () {
				var loader = $(this).prev().prev();
				loader.show();
				
				var imgBlock = $(this).parent();
				$(this).prev().css('opacity', 0.6);
				var src      = $(this).prev().attr('src');
				var data     = parseImgSrc(src);
				$(this).hide();
				
				$.ajax({
					type: 'POST',
					url: "{{ url("admin/image/delete") }}",
					headers: {
						'X-CSRF-Token': "{{ csrf_token() }}"
					},
					data: data,
					success: function(data) {
						if (data.success) {
							imgBlock.fadeOut(300, function() {
								$(this).remove();
							});
						}
					},
					complete: function(){
						loader.hide();
					}
				});
			});
			
			$('#add-input').click(function () {
				var block = addFileBlock();
				$('.image-container').append(block);
			});
			
			var removeFileBlock = function () {
				var parent = $(this).parent();
				parent.remove();
			};
			
			var addFileBlock = function() {
				var parent = $('<p class="form-control" />');
				var input  = $('<input type="file" name="product_image[]" class="add-image" multiple />');
				var icon   = $('<i class="far fa-times-circle float-right remove-input-block"></i>');
				icon.bind('click', removeFileBlock);
				
				parent.append(input).append(icon);
				
				return parent;
			};
			
		</script>
	</div>
@endsection