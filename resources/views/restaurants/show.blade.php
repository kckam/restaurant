@extends('layout.header')

@section('content')
	<a href="../restaurant">Back</a>
	<a href="../restaurant">Edit</a>

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

	
@endsection