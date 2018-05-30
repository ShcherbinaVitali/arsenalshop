@extends('pages.panel.admin')

@php
	$backUrl   = isset($page->id) ? route('admin.static-pages.page', $page->id) : route('admin.static-pages');
	$pageTitle = isset($page->id) ? 'Редактирование Страницы' : 'Создание Страницы';
@endphp

@section('content')
	@parent
	
	<div class="panel-st_pages-wrap container">
		@if( isset($page) && $page->id )
			<div class="row">
				<div class="col-md">
					<h2>{{ $pageTitle }}</h2>
					<form action="{{ route('admin.static-pages.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-page-content">
							<div class="page-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<span>ID:</span>
										<strong>
											{{ $page->id }}
										</strong>
										<input type="hidden" name="id" value="{{ $page->id }}">
									</div>
									<div class="form-group">
										<span>
											@lang('Заголовок страницы'):
										</span>
										<p>
											<input type="text" name="title" value="{{ $page->title }}" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Ссылка страницы'):
										</span>
										<p>
											<input type="text" name="alias" value="{{ $page->alias }}" required class="form-control">
											<span class="note">
												@lang('Должна быть уникальной')
											</span>
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Контент страницы'):
										</span>
										<p>
										<textarea name="content" id="" cols="30" rows="4" class="form-control" required>{!! $page->content !!}</textarea>
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Страница активна'):
										</span>
										<p>
											<input type="checkbox" name="is_active" value="1" class="form-check" 
												@if($page->is_active == 1) 
													checked
												@endif
											>
										</p>
									</div>
								</div>
							</div>
							<div class="meta-info">
								<h3>@lang('Meta инфо')</h3>
								<div class="form-group">
									<span>
										@lang('Meta title'):
									</span>
									<p>
										<input type="text" name="meta_title" value="{{ $page->meta_title }}" required class="form-control">
										<span class="note">
											@lang('максимум 65 символов')
										</span>
									</p>
								</div>
								<div class="form-group">
									<span>
										@lang('Meta Keywords'):
									</span>
									<p>
										<textarea name="meta_keywords" id="" cols="30" rows="4" class="form-control">{{ $page->meta_keywords }}</textarea>
									</p>
								</div>
								<div class="form-group">
									<span>
										@lang('Meta Description'):
									</span>
									<p>
										<textarea name="meta_description" id="" cols="30" rows="4" required class="form-control">{{ $page->meta_description }}</textarea>
										<span class="note">
											@lang('максимум 160 символов')
										</span>
									</p>
								</div>
							</div>
							<div class="additional-info">
								<h3>@lang('Дополнительно')</h3>
								<div class="form-group">
									<span>
										@lang('Порядок'):
									</span>
									<p>
										<input type="number" name="order" value="{{ $page->order }}" class="form-control">
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
					<form action="{{ route('admin.static-pages.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-page-content">
							<div class="page-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<input type="hidden" name="id" value="">
									</div>
									<div class="form-group">
										<span>
											@lang('Заголовок страницы'):
										</span>
										<p>
											<input type="text" name="title" value="" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Ссылка страницы'):
										</span>
										<p>
											<input type="text" name="alias" value="" required class="form-control">
											<span class="note">
												@lang('Должна быть уникальной')
											</span>
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Контент страницы'):
										</span>
										<p>
											<textarea name="content" id="" cols="30" rows="4" class="form-control" required></textarea>
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Страница активна'):
										</span>
										<p>
											<input type="checkbox" name="is_active" value="1" class="form-check">
										</p>
									</div>
								</div>
							</div>
							<div class="meta-info">
								<h3>@lang('Meta инфо')</h3>
								<div class="form-group">
									<span>
										@lang('Meta title'):
									</span>
									<p>
										<input type="text" name="meta_title" value="" required class="form-control">
										<span class="note">
											@lang('максимум 65 символов')
										</span>
									</p>
								</div>
								<div class="form-group">
									<span>
										@lang('Meta Keywords'):
									</span>
									<p>
										<textarea name="meta_keywords" id="" cols="30" rows="4" class="form-control"></textarea>
									</p>
								</div>
								<div class="form-group">
									<span>
										@lang('Meta Description'):
									</span>
									<p>
										<textarea name="meta_description" id="" cols="30" rows="4" required class="form-control"></textarea>
										<span class="note">
											@lang('максимум 160 символов')
										</span>
									</p>
								</div>
							</div>
							<div class="additional-info">
								<h3>@lang('Дополнительно')</h3>
								<div class="form-group">
									<span>
										@lang('Порядок'):
									</span>
									<p>
										<input type="number" name="order" value="" class="form-control">
										<span class="note">
											@lang('числовое значение')
										</span>
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
	</div>
@endsection