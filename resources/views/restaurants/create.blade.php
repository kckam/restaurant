@extends('layout.header')

@section('content')
	<a href="../restaurant">Back</a>

	<h1>Create</h1>

	{!! Form::open(['action' => 'RestaurantsController@store', 'method' => 'POST']) !!}
    
	
	<table class="details_table">
		<tr>
			<td>
				{{FORM::label('name', 'Name')}}
			</td>

			<td>
				{{FORM::text('name', '',['class' => ''])}}
			</td>
		</tr>

		<tr>
			<td>
				{{FORM::label('category', 'Category')}}
			</td>

			<td>
				
				{{Form::select('category', $category_data, '', ['placeholder' => 'Select category'])}}
			</td>
		</tr>

		<tr>
			<td>
				{{FORM::label('latitude', 'Latitude')}}
			</td>

			<td>
				{{FORM::text('latitude', '',['class' => ''])}}
			</td>
		</tr>

		<tr>
			<td>
				{{FORM::label('longitude', 'Longitude')}}
			</td>

			<td>
				{{FORM::text('longitude', '',['class' => ''])}}
			</td>
		</tr>
	</table>

	<div id="show_map">

	</div

	{{Form::hidden('_method', 'POST')}}
	{{Form::submit('Submit',['class'=>'btn'])}}
	{!! Form::close() !!}
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNiq1E1LKCPddo5c-Oze32P7bRNa4vvBc&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
	function initMap() {
        var position = {lat: 1.290270, lng: 103.851959};
        var map = new google.maps.Map(document.getElementById('show_map'), {
          zoom: 12,
          center: position,
          disableDefaultUI: true
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