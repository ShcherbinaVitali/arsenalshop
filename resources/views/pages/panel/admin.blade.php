@extends('layouts.admin-page')

@php
	$admin = \App\Helpers\AppHelper::getCurrentAdmin();
@endphp

@section('content')
	<div class="admin-wrap container">
		<div class="row">
			<div class="col-md">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="{{ route('admin.dashboard') }}">Dashboard</a>
					</div>
					
					<div class="panel-body clearfix">
						<div class="float-left">
							You are logged in as <strong>{{ $admin->name }}</strong>
						</div>
						<div class="float-right">
							<a href="{{ route('admin.logout') }}" class="btn btn-secondary">Logout</a>
						</div>
					</div>
					<div class="panel-content">
						<div class="panel-menu">
							<ul>
								<li>
									<a href="{{ route('admin.static-pages') }}">
										@lang('Страницы')
									</a>
								</li>
								<li>
									<a href="{{ route('admin.categories') }}">
										@lang('Категории')
									</a>
								</li>
								<li>
									<a href="{{ route('admin.products') }}">
										@lang('Товары')
									</a>
								</li>
							</ul>
						</div>
						
						<div class="messages">
							@if( session('message') )
								<div class="alert alert-warning" role="alert">
									@if(is_array(session('message')))
										@foreach(session('message') as $message)
											{{ $message }}
										@endforeach
									@else
										{{ session('message') }}
									@endif
								</div>
							@endif
						</div>
						@php
							session()->forget('message');
						@endphp
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection