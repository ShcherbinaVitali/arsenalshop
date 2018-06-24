<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="robots" content="index, follow, all">
		
		<link rel="stylesheet" href="/css/vendor/bootstrap-4.0.0/bootstrap.min.css">
		
		<link rel="stylesheet" href="/css/style.css">
		
		<script src="/js/vendor/jquery-3.3.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		
		<script src="/js/vendor/bootstrap-4.0.0/bootstrap.min.js"></script>
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
		<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
		
		<link rel="stylesheet" href="/css/vendor/fontawesome/fontawesome-all.min.css">
		
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
					
					if (
						$cat === false
					) {
						session()->forget('category.active');
					}
				@endphp
				@include('layouts.left')
				
				@yield('content')
				@yield('content-after')
			</div>
		</div>
		
		@include('layouts.footer-links')
		@include('layouts.footer')
		
		<div class="up">
			<i class="fas fa-angle-double-up"></i>
		</div>
		
		@yield('beforeBodyEnd')
	</body>
</html>