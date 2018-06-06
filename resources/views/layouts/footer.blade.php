@php
	$startYear = 2018;
	$curYear   = date("Y");
	$fullYear  = '';
	
	if ($curYear > $startYear) {
		$fullYear = $startYear . ' - ' . $curYear;
	}
	else {
		$fullYear = $curYear;
	}
@endphp

<div class="footer-wrap">
	<footer class="footer container">
		<div>
			<span>&copy;</span>
			{{ $fullYear }}
		</div>
	</footer>
</div>