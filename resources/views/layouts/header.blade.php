<div class="header-wrap">
	<header class="header container">
		<div class="clearfix">
			<div class="logo-wrap float-left">
				@if(Request::is('/'))
					<span class="logo">logo</span>
				@else
					<a href="/" class="logo">logo</a>
				@endif
			</div>
			<div class="header-contacts float-right">
				contacts
			</div>
		</div>
	</header>
</div>