<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		
		<link rel="stylesheet" href="/css/style.css">
		
		<script src="/js/vendor/jquery-3.3.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		
		@yield('header.styles')
		
		@yield('header.scripts')
		
		@yield('meta-tags')
		
	</head>
	<body>
		@include('layouts.header')
		@include('layouts.top-menu')
		@include('layouts.breadcrumbs')
		<div class="page-container container">
			@include('layouts.messages')
			<div class="row">
				@php
					$urlPath = request()->path();
					$cat     = strpos($urlPath, 'catalog');
					$prod    = strpos($urlPath, 'product');
					
					if (
						$cat === false
						&& $prod === false
					) {
						session()->forget('category.active');
					}
				@endphp
				@include('layouts.left')
				
				@yield('content')
			</div>
		</div>
		@include('layouts.footer')
		
		<div class="up">
			<i class="fas fa-angle-double-up"></i>
		</div>
		
		@yield('beforeBodyEnd')
	</body>
</html>