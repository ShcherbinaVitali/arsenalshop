@php
	$contacts = \App\Helpers\AppHelper::getFromInfoByTitle('contacts');
@endphp

@if( $contacts )
	<div class="contacts-wrap">
		{!! html_entity_decode($contacts->content) !!}
	</div>
@endif