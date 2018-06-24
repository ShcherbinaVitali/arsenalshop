<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="/css/vendor/bootstrap-4.0.0/bootstrap.min.css">
	
	<link rel="stylesheet" href="/css/style.css">
	
	<script src="/js/vendor/jquery-3.3.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	
	<script src="/js/vendor/bootstrap-4.0.0/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="/css/vendor/fontawesome/fontawesome-all.min.css">
	
	<script src='/js/vendor/tinymce/tinymce.min.js'></script>
	<script>
		tinymce.init({
			selector: '#content',
			extended_valid_elements: 'span[class]',
			valid_elements : 'i[class]',
			forced_root_block : '',
			theme: 'modern',
			height: 300,
			plugins : 'advlist autolink link image lists charmap preview code textcolor colorpicker table',
			toolbar: "undo redo forecolor backcolor | bold italic underline | fontsizeselect alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image charmap code",
			indentation : '30px'
		});
	</script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	
	<title>Admin</title>
</head>
<body>
<div class="page-container container admin">
	<div class="row">
		@yield('content')
	</div>
</div>
@include('layouts.footer')
@yield('beforeBodyEnd')
</body>
</html>