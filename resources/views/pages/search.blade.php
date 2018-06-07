@extends('layouts.page')

@section('meta-tags')
	<title>@lang('Страница поиска')</title>
	<meta name="description" content="@lang('Поиск по товарам')">
	<meta name="keywords" content="@lang('Поиск')">
@endsection

@section('content')
	<div class="col-md-8">
		<div class="search-results container">
			<h1>@lang('Результаты поиска') "@php echo $query; @endphp"</h1>
			<div class="row">
				@if( isset($product_result) && count($product_result) > 0 )
					@foreach($product_result as $item)
						<div class="col-md-12 search-item">
							<h2>{{ $item->title }}</h2>
							<div>
								<div class="search-description">
									<h4>@lang('Описание')</h4>
								</div>
								{!! html_entity_decode($item->description) !!}
							</div>
							<a href="{{ route('catalog.category', $item->alias) }}" class="product-more">
								@lang('Подробнее...')
							</a>
						</div>
					@endforeach
				@else
					<div class="col-md-12">
						@lang('По данному запросу результатов не найдено')
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection