@extends('pages.panel.admin')

@php
	$backUrl = route('admin.main-info');
@endphp

@section('content')
	@parent
	
	<div class="panel-info-wrap container">
		@if( isset($info) && $info->id )
			<div class="row">
				<div class="col-md">
					<div class="button-group text-left">
						<a href="{{ $backUrl }}" class="btn btn-secondary">
							@lang('Назад')
						</a>
						<a href="{{ route('admin.main-info.edit', $info->id) }}" class="btn btn-primary">
							@lang('Редактировать')
						</a>
						<a href="{{ route('admin.main-info.delete', $info->id) }}" class="btn btn-danger">
							@lang('Удалить')
						</a>
					</div>
					<div class="panel-info-content">
						<div class="main-info">
							<div>
								<h3>
									@lang('Основная информация')
								</h3>
								<div>
									<strong>ID:</strong>
									<span>
										{{ $info->id }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Имя'):
									</strong>
									<span>
										{{ $info->title }}
									</span>
								</div>
								<div>
									<strong>
										@lang('Контент'):
									</strong>
									<div>
										{!! html_entity_decode($info->content) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection