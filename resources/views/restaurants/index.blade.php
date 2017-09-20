@extends('layout.header')

@section('content')
	<a href="./restaurant/create">Create</a>
	<h1>Restaurants</h1>

	@if(count($restaurants) > 0)
		<ul class="list_wrapper">
		@foreach($restaurants as $restaurant)
			<li class="list"><a href="./restaurant/{{$restaurant->id}}">{{$restaurant->name}}</li>
		@endforeach
		</ul>
	@else
		<p>No Record.</p>
	@endif
@endsection