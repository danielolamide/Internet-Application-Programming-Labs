@extends('layouts.app')
@section('content')
@if ( isset($students) )
<div class="container">
    @if (!count($students) > 0)
        <span>No payments found</span>
    @else
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Full Name</th>
                <th>Total Amount Paid</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($students as $student)
            <tr>
                <td> {{$student->student_id}} </td>
                <td>{{$student->fullname}}</td>
                <td> {{$student->total}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endif
@endsection