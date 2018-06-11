@extends('pages.panel.admin')

@php
	$backUrl   = isset($info->id) ? route('admin.main-info.info', $info->id) : route('admin.main-info');
	$infoTitle = isset($info->id) ? 'Редактирование' : 'Создание';
@endphp

@section('content')
	@parent
	
	<div class="panel-st_pages-wrap container">
		@if( isset($info) && $info->id )
			<div class="row">
				<div class="col-md">
					<h2>{{ $infoTitle }}</h2>
					<form action="{{ route('admin.main-info.save') }}" method="post" enctype="multipart/form-data">
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-info-content">
							<div class="main-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<span>ID:</span>
										<strong>
											{{ $info->id }}
										</strong>
										<input type="hidden" name="id" value="{{ $info->id }}">
									</div>
									<div class="form-group">
										<span>
											@lang('Имя'):
										</span>
										<p>
											<input type="text" name="title" value="{{ $info->title }}" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Контент'):
										</span>
										<p>
											<textarea name="content" id="content" class="form-control">
												{!! html_entity_decode($info->content) !!}
											</textarea>
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
					<h2>{{ $infoTitle }}</h2>
					<form action="{{ route('admin.main-info.save') }}" method="post" enctype="multipart/form-data"><!--novalidate-->
						@csrf
						
						<div class="button-group text-left">
							<a href="{{ $backUrl }}" class="btn btn-secondary">
								@lang('Назад')
							</a>
							<button class="btn btn-primary" type="submit">
								@lang('Сохранить')
							</button>
						</div>
						<div class="panel-info-content">
							<div class="main-info">
								<div>
									<h3>
										@lang('Основная информация')
									</h3>
									<div class="form-group">
										<input type="hidden" name="id" value="">
									</div>
									<div class="form-group">
										<span>
											@lang('Имя'):
										</span>
										<p>
											<input type="text" name="title" value="" required class="form-control">
										</p>
									</div>
									<div class="form-group">
										<span>
											@lang('Контент'):
										</span>
										<p>
											<textarea name="content" id="content" class="form-control"></textarea>
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