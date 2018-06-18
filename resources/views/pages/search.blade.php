@extends('layouts.page')

@section('meta-tags')
	<title>@lang('Страница поиска')</title>
	<meta name="description" content="@lang('Поиск по товарам')">
	<meta name="keywords" content="@lang('Поиск')">
@endsection

@section('content')
	<div class="col-sm-9 col-md-9 col-lg-9">
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
								<div>
									{!! \App\Helpers\AppHelper::cutTextByChars(html_entity_decode($item->description)) !!}
								</div>
							</div>
							
							@include('layouts.more-link', ['product' => $item])
							
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