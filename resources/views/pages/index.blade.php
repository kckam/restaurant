@extends('layout.header')

@section('content')

@if (count($category_data) > 0)
<div class="all_restaurant_wrapper">
	<div id="all_restaurant" style="width:100%; height: 300px;">

	</div>
</div>

<div class="filter_wrapper">
	<select class="filter">
		<option value="">Filter</option>
	@foreach ($category_data as $key => $category)
	    <option value="{{$key}}">{{$category}}</option>
	@endforeach
	</select>
</div>

<div class="restaurant_wrapper">

</div>
@endif

<div class="full_page">
	<div class="container">
		<div class="close_page">close</div>
		<div class="content"></div>
	</div>
	
</div>


@endsection

<script id="list-template" type="text/x-handlebars-template">
  <ul class="restaurants">
	@{{#each this}}
	<li class="restaurant" data-id="@{{this.id}}">
		<h2>@{{this.name}} - @{{this.category_name}}</h2>
		<div class="map" id="map@{{this.id}}"></div>
		<div class="overlay">
			<div class="overlay_content">
				<h3>@{{this.name}} - @{{this.category_name}}</h3>
			</div>
		</div>
	</li>
	@{{else}}
		<p>No result.</p>
    @{{/each}}
 </ul>
</script>

<script id="details-template" type="text/x-handlebars-template">
	<h1>@{{this.name}} - @{{this.category_name}}</h1>
	<div id="details_map" style="width:100%; height: 300px;">
		
	</div>
	@{{#with this.map_details.routes.[0].legs.[0]}}
		<h3>Total Distance: @{{convertKm this.distance.value}}km &nbsp;&nbsp;&nbsp; Est. Time: @{{this.duration.text}}</h3>
		<ul class="instructions">
		@{{#each this.steps}}
			<li class="instruction">@{{{this.instructions}}} - @{{{this.distance.value}}}m</li>
		@{{/each}}
		</ul>
	@{{/with}}
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNiq1E1LKCPddo5c-Oze32P7bRNa4vvBc&libraries=places"></script>
<script src="./js/restaurant.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js"></script>

<script>
Handlebars.registerHelper("convertKm", function(value) {
   return parseFloat(value/1000).toFixed(2);
});
</script>