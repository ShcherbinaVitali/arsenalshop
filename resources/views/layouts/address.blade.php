<div class="address-wrap">
	<div class="address-title">
		<i class="fa fa-map-marker"></i>
		<span>@lang('Офис и склад'):</span>
	</div>
	<div class="address-location">
		<span>
			@lang('г.Могилев, ул.Криулина 27а')
		</span>
	</div>
	<div class="show-map">
		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#store_map">@lang('Смотреть карту проезда')</button>
	</div>
</div>

@section('beforeBodyEnd')
	@parent
	<!-- Modal -->
	<div class="modal fade" id="store_map" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="{{ url("send-request") }}" method="post" id="order_call">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title">@lang('Карта проезда')</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="map"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		ymaps.ready(init);
		var map,
			store;
		
		function init(){
			map = new ymaps.Map("map", {
				center: [53.955119, 30.332361],
				zoom: 12
			});
			
			store = new ymaps.Placemark([53.955119, 30.332361],
				{
					hintContent: 'Arsenal',
					balloonContent: 'Офис и склад'
				},
				{
					preset: 'islands#glyphIcon',
					iconGlyphColor: 'blue'
				}
			);
			
			map.geoObjects.add(store);
		}
	</script>
@endsection