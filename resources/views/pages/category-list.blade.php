@extends('layouts.page')

@section('content')
	<div class="content col-sm-8 col-md-8 col-lg-8 category-list">
		<div class="container">
			<div class="row">
				@if(count($categories) > 0)
					@foreach($categories as $category)
						<div class="col-md-4 category">
							<a href="{{ route('catalog.category', $category->alias) }}">
								{{ $category->title }}
							</a>
							@if(isset($category->subcategories) && count($category->subcategories) > 0)
								<div class="subcategories">
									@foreach($category->subcategories as $subcategory)
										<a href="{{ route('catalog.category',[$category->alias, $subcategory->alias]) }}">
											{{ $subcategory->title }}
										</a>
									@endforeach
								</div>
							@endif
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
@endsection