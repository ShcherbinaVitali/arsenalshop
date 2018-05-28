@extends('layouts.page')

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<div class="container">
			<div class="product-wrap">
				<div class="page-title">
					<h1>{{ $content->title }}</h1>
				</div>
				<div class="product-price">
					{{ $content->price }}
					<span>@lang('BYR')</span>
				</div>
			</div>
		</div>
	</div>
@endsection