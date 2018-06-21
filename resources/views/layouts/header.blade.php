@php
	$creds = \App\Helpers\AppHelper::getCaptchaCreds();
@endphp

<div class="header-wrap">
	<div class="top-header">
		<div class="container clearfix">
			<ul class="header-links pull-left">
				<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
				<li><a href="#"><i class="far fa-envelope"></i> email@email.com</a></li>
				<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
			</ul>
			<div class="header-search float-right">
				<form action="{{ route('search') }}" method="get">
					<input class="input search-input" name="query" type="text" placeholder="@lang('Поиск')" required>
					<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</div>
	<header class="header container">
		<div class="row">
			<div class="logo-wrap col-md-3">
				@if(Request::is('/'))
					<span class="logo">
						<img src="{{ asset('images/general/logo.png') }}" alt="logo">
					</span>
				@else
					<a href="/" class="logo">
						<img src="{{ asset('images/general/logo.png') }}" alt="logo">
					</a>
				@endif
			</div>
			<div class="order-call col-md-2 offset-md-4 text-center">
				<button href="#" class="btn btn-primary" data-toggle="modal" data-target="#callOrderModal">
					@lang('Заказать звонок')
				</button>
			</div>
			<div class="header-contacts col-md-3 text-right">
				@include('layouts.contacts')
			</div>
		</div>
	</header>
</div>

@section('beforeBodyEnd')
	@parent
	<!-- Modal -->
	<div class="modal fade" id="callOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="{{ url("send-request") }}" method="post" id="order_call">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title">@lang('Заказать звонок')</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<fieldset class="form-group">
							<label for="name">@lang('Ваше имя')</label>
							<input type="text" name="name" id="name" class="form-control" required minlength="3" maxlength="150">
						</fieldset>
						<fieldset class="form-group">
							<label for="phone">@lang('Ваш номер')</label>
							<input type="text" id="phone" name="phone" class="form-control" required maxlength="20">
							<small id="senderHelp" class="form-text text-muted">@lang('Пример: +375 ## ### ## ## или сокращенно с кодом оператора')</small>
						</fieldset>
						<fieldset class="form-group">
							<label for="topic">@lang('Тема')</label>
							<textarea name="topic" id="topic" class="form-control" maxlength="350"></textarea>
						</fieldset>
						@if( $creds && is_array($creds) )
							<fieldset class="form-group">
								<div class="g-recaptcha" data-sitekey="{{ $creds['sitekey'] }}" style="transform:scale(0.9);-webkit-transform:scale(0.9);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
							</fieldset>
						@endif
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							@lang('Закрыть')
						</button>
						<button type="submit" class="btn btn-primary">
							@lang('Отправить')
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection