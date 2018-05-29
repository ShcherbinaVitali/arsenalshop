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
									<span>ID:</span>
									<strong>
										{{ $page->id }}
									</strong>
								</div>
								<div>
									<span>
										@lang('Заголовок'):
									</span>
									<strong>
										{{ $page->title }}
									</strong>
								</div>
								<div>
									<span>
										@lang('Ссылка'):
									</span>
									<strong>
										{{ $page->alias }}
									</strong>
								</div>
								<div>
									<span>
										@lang('Контент'):
									</span>
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
								<span>
									@lang('Meta title'):
								</span>
								<strong>
									{{ $page->meta_title }}
								</strong>
							</p>
							<p>
								<span>
									@lang('Meta Keywords'):
								</span>
								<strong>
									{{ $page->meta_keywords }}
								</strong>
							</p>
							<p>
								<span>
									@lang('Meta Description'):
								</span>
								<strong>
									{{ $page->meta_description }}
								</strong>
							</p>
						</div>
						<hr>
						<div class="meta-info">
							<h3>@lang('Дополнительно')</h3>
							<p>
								<span>
									@lang('Порядок'):
								</span>
								<strong>
									{{ $page->order }}
								</strong>
							</p>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection