@extends('pages.panel.admin')

@php
	$backUrl = Request::server('HTTP_REFERER');
@endphp

@section('content')
	@parent
	
	<div class="panel-st_pages-wrap container">
		@if( isset($page) && $page->id )
			<div class="row">
				<div class="col-md">
					<div class="button-group text-left">
						<a href="{{ $backUrl }}" class="btn btn-secondary">
							@lang('Назад')
						</a>
						<a href="{{ route('admin.static-pages.edit', $page->id) }}" class="btn btn-primary">
							@lang('Редактировать')
						</a>
						<a href="{{ route('admin.static-pages.delete', $page->id) }}" class="btn btn-danger">
							@lang('Удалить')
						</a>
					</div>
					<div class="panel-page-content">
						<div class="page-info">
							<div>
								<h3>
									@lang('Основная информация')
								</h3>
								<div>
									<strong>ID:</strong>
									<span>
										{{ $page->id }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Заголовок'):
									</strong>
									<span>
										{{ $page->title }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Ссылка'):
									</strong>
									<span>
										{{ $page->alias }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Контент'):
									</strong>
									<div>
										{!! $page->content !!}
									</div>
								</div>
								<div>
									@if( $page->is_active )
										<strong>
											@lang('Страница активирована')
										</strong>
									@else
										<strong>
											@lang('Страница не активирована')
										</strong>
									@endif
								</div>
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
									{{ $page->meta_title }}
								</span>
							</p>
							<p>
								<strong>
									@lang('Meta Keywords'):
								</strong>
								<span>
									{{ $page->meta_keywords }}
								</span>
							</p>
							<p>
								<strong>
									@lang('Meta Description'):
								</strong>
								<span>
									{{ $page->meta_description }}
								</span>
							</p>
						</div>
						<hr>
						<div class="meta-info">
							<h3>@lang('Дополнительно')</h3>
							<p>
								<strong>
									@lang('Порядок'):
								</strong>
								<span>
									{{ $page->order }}
								</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection