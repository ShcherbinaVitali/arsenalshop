@extends('pages.panel.admin')

@php
	$backUrl = route('admin.categories');
@endphp

@section('content')
	@parent
	
	<div class="panel-categories-wrap container">
		@if( isset($category) && $category->id )
			<div class="row">
				<div class="col-md">
					<div class="button-group text-left">
						<a href="{{ $backUrl }}" class="btn btn-secondary">
							@lang('Назад')
						</a>
						<a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
							@lang('Редактировать')
						</a>
						<a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-danger">
							@lang('Удалить')
						</a>
					</div>
					<div class="panel-category-content">
						<div class="category-info">
							<div>
								<h3>
									@lang('Основная информация')
								</h3>
								<div>
									<strong>ID:</strong>
									<span>
										{{ $category->id }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Заголовок'):
									</strong>
									<span>
										{{ $category->title }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Ссылка'):
									</strong>
									<span>
										{{ $category->alias }}
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
									@if( $category->is_active )
										<strong>
											@lang('Категория активирована')
										</strong>
									@else
										<strong>
											@lang('Категория не активирована')
										</strong>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection