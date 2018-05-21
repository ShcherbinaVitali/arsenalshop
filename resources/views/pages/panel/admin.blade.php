@extends('layouts.admin-page')

@section('content')
	<div class="admin-wrap container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>
					
					<div class="panel-body clearfix">
						<div class="float-left">
							You are logged in as <strong>{{ $admin->name }}</strong>
						</div>
						<div class="float-right">
							<a href="{{ route('admin.logout') }}" class="btn btn-primary">Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection