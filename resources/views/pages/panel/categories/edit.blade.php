@extends('pages.panel.admin')

@php
	$backUrl   = isset($category->id) ? route('admin.categories.category', $category->id) : route('admin.categories');
	$pageTitle = isset($category->id) ? 'Редактирование Категории' : 'Создание Категории';
@endphp

@section('content')
	@parent
	
	<div class="panel-categories-wrap container">
		@if( isset($category) && $category->id )
			<div class="row">
				<div class="col-md">
					<h2>{{ $pageTitle }}</h2>
					<form action="{{ route('admin.categories.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-category-content">
							<div class="category-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<strong>ID:</strong>
										<span>
											{{ $category->id }}
										</span>
										<input type="hidden" name="id" value="{{ $category->id }}">
									</div>
									<div class="form-group">
										<strong>
											@lang('Заголовок категории'):
										</strong>
										<p>
											<input type="text" name="title" value="{{ $category->title }}" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Ссылка категории'):
										</strong>
										<p>
											<input type="text" name="alias" value="{{ $category->alias }}" required class="form-control">
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
											<select name="parent_id" class="form-control">
												<option value="0" selected>@lang('Корневая Категория')</option>
												@foreach($category_list as $item)
													<option value="{{ $item->id }}"
														@if(!$item->is_active)
															disabled
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
											@lang('Категория активна'):
										</strong>
										<p>
											<input type="checkbox" name="is_active" value="1" class="form-check" 
												@if( $category->is_active == 1 )
													checked
												@endif
											>
										</p>
									</div>
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
					<form action="{{ route('admin.categories.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-category-content">
							<div class="category-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<input type="hidden" name="id" value="">
									</div>
									<div class="form-group">
										<strong>
											@lang('Заголовок категории'):
										</strong>
										<p>
											<input type="text" name="title" value="" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Ссылка категории'):
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
											<select name="parent_id" class="form-control">
												<option value="0" selected>@lang('Корневая Категория')</option>
												@foreach($category_list as $category)
													<option value="{{ $category->id }}"
															@if(!$category->is_active)
															disabled
															@endif
													>
														{{ $category->title }}
													</option>
												@endforeach
											</select>
										</p>
									</div>
									<div class="form-group">
										<strong>
											@lang('Категория активна'):
										</strong>
										<p>
											<input type="checkbox" name="is_active" value="1" class="form-check">
										</p>
									</div>
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
	</div>
@endsection