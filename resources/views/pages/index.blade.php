@extends('layout.header')

@section('content')

@if (count($category_data) > 0)
<div class="filter_wrapper">
	<select class="filter">
		<option>Filter</option>
	@foreach ($category_data as $key => $category)
	    <option value="{{$key}}">{{$category}}</option>
	@endforeach
	</select>
</div>

<div class="restaurant_wrapper">

</div>
@endif


@endsection

<script id="list-template" type="text/x-handlebars-template">
  <ul class="restaurants">
	@{{#each this}}
	<li class="restaurant">
		<h2>@{{this.name}} - @{{this.category_name}}</h2>
		<div id="map@{{this.id}}" style="width:100%; height: 300px;"></div>
	</li>
    @{{/each}}
 </ul>
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNiq1E1LKCPddo5c-Oze32P7bRNa4vvBc&libraries=places" async defer></script>
<script src="./js/restaurant.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.10/handlebars.min.js"></script>