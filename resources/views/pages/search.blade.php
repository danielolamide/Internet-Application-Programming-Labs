@extends('layouts.app')
@section('content')
    @error('student_id')
    <div class="container grey lighten-5 red-text text-darken-1" style ="margin-bottom : 10px; padding: 10px;">
        <div class="row">
            <div class="col s12 m12 l12">
                {{ $message }}
            </div>
        </div>
    </div>
    @enderror
    <div class="center-align container">
        <h3>Search Student Payments</h3>
    </div>
    <div class="container" style="padding: 20px 0;">
        <div class="row">
            <form method="post" action="/search">
                @csrf
                <div class="input-field col s12">
                    <input placeholder="Student ID" name='student_id' id="student_id" type="text" class="validate">
                    <label for="student_id">Student ID</label>
                </div>  
                <div class="center-align col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="search_btn">Search
                        <i class="material-icons right">search</i>
                    </button>
                </div>
        </div>
    </div>
    @if ( isset($student) )
        <div class="container">
            <div class = 'center-align'><h4>Payments for <span>{{$student->fullname.' '.$student->student_id}}</span></h4></div>
            @if (!count($student->fees) > 0)
                <span>No records found</span>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Amount Paid</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($student->fees as $fee)
                    <tr>
                        <td>{{$fee->amount_paid}}</td>
                        <td> {{$fee->payment_date}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    @endif
@endsection