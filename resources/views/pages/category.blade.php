@extends('layouts.page')

@section('meta-tags')
	<title>{{ $content->title }}</title>
	<meta name="description" content="">
@endsection

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8">
		<div>
			@if($content)
				<h1>
					{{ $content->title }}
				</h1>
				@if(isset($content->subcategories) && count($content->subcategories) > 0)
					<div class="container">
						<h3>@lang('Подкатегории')</h3>
						<div class="row">
							@foreach($content->subcategories as $subcategory)
								<div class="col-md-3">
									<a href="{{ route('catalog.category',[$content->alias, $subcategory->alias]) }}">
										{{ $subcategory->title }}
									</a>
								</div>
							@endforeach
						</div>
					</div>
				@endif
				@if(isset($content->products) && count($content->products) > 0)
					<div class="container">
						<h3>@lang('Продукты')</h3>
						<div class="row">
							@foreach($content->products as $product)
								<div class="col-md-3">
									<a href="{{ route('catalog.category', [$content->alias, $product->alias]) }}">
										{{ $product->title }}
									</a>
								</div>
							@endforeach
						</div>
					</div>
				@else
					<div>
						<h4>
							@lang('В данной категории нет продуктов')
						</h4>
					</div>
				@endif
			@endif
		</div>
	</div>
@endsection