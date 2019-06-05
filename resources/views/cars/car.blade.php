@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="card">
		<div class="card-header text-uppercase font-weight-bold text-primary">Car #{{ $car->id }}</div>
		<div class="card-body row">
			<div class="col-md-4">
				<h5>
					Car make: <span class="text-info">{{ $car->make }}</span>
				</h5>
				<h5>
					Car model: <span class="text-info">{{ $car->model }}</span>
				</h5>
				<h5>
					Production date: <span class="text-info">{{ $car->produced_on }}</span>
				</h5>
				<hr>
			</div>
			<div class="col-md-8">
				<h4>Car reviews</h4> <hr>
			</div>
		</div>
	</div>
</div>
@endsection
