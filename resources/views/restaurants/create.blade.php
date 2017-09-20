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
				
				{{Form::select('category', $category_data)}}
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
	{{Form::submit('Submit',['class'=>'submit-btn'])}}
	{!! Form::close() !!}
@endsection