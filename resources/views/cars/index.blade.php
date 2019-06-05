@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">Car records</div>
		<div class="card-body">
			@isset($cars)
				@if (count($cars) === 0)
					<h3>No records</h3>
				@else
					@php
						$count = 0;
					@endphp
					<table class="table table-striped table-bordered table-responsive">
						<thead class="thead-dark">
							<th width="5%">#</th>
							<th>Car make</th>
							<th>Car model</th>
							<th>Production date</th>
							<th>Actions</th>
						</thead>
						<tbody>
							@foreach ($cars as $car)
							<tr>
							<td>{{ ++$count }}</td>
								<td>{{ $car->make }}</td>
								<td>{{ $car->model }}</td>
								<td>{{ $car->produced_on }}</td>
								<td class="d-flex">
									<a href="{{url('cars/'.$car->id)}}" class="btn btn-info mr-2">View</a>
									<a href="{{url('cars/'.$car->id.'/edit')}}" class="btn btn-secondary mr-2">Edit</a>
									<form action="{{ url('cars/'.$car->id) }}" method="post">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger">Delete</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@endif
			@endisset
		</div>
	</div>
</div>
@endsection
