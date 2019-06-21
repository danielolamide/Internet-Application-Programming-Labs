@extends('layouts.app')

@section('content')
<div class = 'center-align container ' style ="padding: 20px;">
    <h2>Fee Management System</h2>
    <div class="row">
        <div class="col s12 m6">
            <a href="/register" class=" waves-effect waves-light btn-large">Student</a>
        </div>
        <div class="col s12 m6">
            <a href='/fees' class="waves-effect waves-light btn-large">Fees</a>
        </div>
    </div>
</div>
@endsection
