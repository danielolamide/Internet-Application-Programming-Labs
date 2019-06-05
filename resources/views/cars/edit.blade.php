@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card">
		<div class="card-header text-uppercase">Edit record details</div>
		<div class="card-body">
			<form action="{{ url('/cars/'.$car->id) }}" method="post">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-md-6">
						<label for="make">Car make</label>
						<input type="text" name="make" id="make" class="form-control @error('make') is-invalid @enderror" value="{{ old('make', $car->make) }}" autofocus>
						@error('make')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label for="model">Car model</label>
						<input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model', $car->model) }}">
						@error('model')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-6">
						<label for="produced_on">Produced on</label>
						<input type="date" name="produced_on" id="produced_on" class="form-control @error('produced_on') is-invalid @enderror" value="{{ old('produced_on',$car->produced_on) }}">
						@error('produced_on')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group col-md-6 d-flex flex-column align-items-baseline">
						<input type="submit" value="Submit changes" class="btn btn-primary mt-auto">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
