@extends('layout.header')

@section('content')
	{!! Form::open(['action' => ['RestaurantsController@destroy', $restaurant->id], 'method' => 'POST']) !!}
	{{Form::submit('Delete',['class'=>'btn red-btn'])}}
	{{Form::hidden('_method', 'DELETE')}}
	{!! Form::close() !!}

	<h1>Edit</h1>

	{!! Form::open(['action' => ['RestaurantsController@update', $restaurant->id], 'method' => 'POST']) !!}
    
	
	<table class="details_table">
		<tr>
			<td>
				{{FORM::label('name', 'Name')}}
			</td>

			<td>
				{{FORM::text('name', $restaurant->name,['class' => ''])}}
			</td>
		</tr>

		<tr>
			<td>
				{{FORM::label('category', 'Category')}}
			</td>

			<td>
				{{Form::select('category', $category_data, $restaurant->category, ['placeholder' => 'Select category'])}}
			</td>
		</tr>

		<tr>
			<td>
				{{FORM::label('latitude', 'Latitude')}}
			</td>

			<td>
				{{FORM::text('latitude', $restaurant->lat,['class' => ''])}}
			</td>
		</tr>

		<tr>
			<td>
				{{FORM::label('longitude', 'Longitude')}}
			</td>

			<td>
				{{FORM::text('longitude', $restaurant->long,['class' => ''])}}
			</td>
		</tr>
	</table>

	<div id="show_map">

	</div>
	{{Form::hidden('_method', 'PUT')}}
	{{Form::submit('Submit',['class'=>'btn'])}}
	{!! Form::close() !!}

	
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