@extends('layouts.admin-page')

@section('content')
	<div class="admin-wrap container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
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
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection