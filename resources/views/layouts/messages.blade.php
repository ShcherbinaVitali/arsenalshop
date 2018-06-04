<div class="messages">
	@if( session('p_message') )
		<div class="alert alert-warning" role="alert">
			@if(is_array(session('p_message')))
				@foreach(session('p_message') as $message)
					{{ $message }}
				@endforeach
			@else
				{{ session('p_message') }}
			@endif
		</div>
	@endif
</div>
@php
	session()->forget('p_message');
@endphp