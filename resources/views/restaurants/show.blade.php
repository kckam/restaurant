@extends('layout.header')

@section('content')
	<a href="../restaurant" class="btn">Back</a>
	<a href="../restaurant/{{$restaurant->id}}/edit" class="btn">Edit</a>

	<h1>View</h1>
	<table class="details_table">
		<tr>
			<td>
				Name:
			</td>

			<td>
				{{$restaurant->name}}
			</td>
		</tr>

		<tr>
			<td>
				Category:
			</td>

			<td>
				{{$restaurant->category_name}}
			</td>
		</tr>

		<tr>
			<td>
				Latitude:
			</td>

			<td>
				{{$restaurant->lat}}
			</td>
		</tr>

		<tr>
			<td>
				Longitude:
			</td>

			<td>
				{{$restaurant->long}}
			</td>
		</tr>
	</table>

	<div id="show_map">

	</div>
	
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNiq1E1LKCPddo5c-Oze32P7bRNa4vvBc&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
	function initMap() {
        var position = {lat: {!! $restaurant->lat !!}, lng: {!! $restaurant->long !!}};
        var map = new google.maps.Map(document.getElementById('show_map'), {
          zoom: 12,
          center: position
        });

        var marker = new google.maps.Marker({
          position: position,
          map: map
        });

       google.maps.event.addListener(map, 'click', function(event){
       		$("input[name='latitude']").val(event.latLng.lat());
       		$("input[name='longitude']").val(event.latLng.lng());
          	marker.setMap(null);
       		marker = new google.maps.Marker({
	          position: {
	          	"lat": event.latLng.lat(),
	          	"lng": event.latLng.lng()
	          },
	          map: map
	        });
		});
      }

</script>