@extends('layouts.app')
@section('content')
    @error('full_name')
    <div class="container grey lighten-5 red-text text-darken-1" style ="margin-bottom : 10px; padding: 10px;">
        <div class="row">
            <div class="col s12 m12 l12">
                {{ $message }}
            </div>
        </div>
    </div>
    @enderror
    @error('student_id')
    <div class="container grey lighten-5 red-text text-darken-1" style ="margin-bottom : 10px; padding: 10px;">
        <div class="row">
            <div class="col s12 m12 l12">
                {{ $message }}
            </div>
        </div>
    </div>
    @enderror
    @error('date_of_birth')
    <div class="container grey lighten-5 red-text text-darken-1" style ="margin-bottom : 10px; padding: 10px;">
        <div class="row">
            <div class="col s12 m12 l12">
                {{ $message }}
            </div>
        </div>
    </div>
    @enderror
    @error('address')
    <div class="container grey lighten-5 red-text text-darken-1" style ="margin-bottom : 10px; padding: 10px;">
        <div class="row">
            <div class="col s12 m12 l12">
                {{ $message }}
            </div>
        </div>
    </div>
    @enderror
    @if(session()->has('msg'))
        <div class="container grey lighten-5 green-text text-lighten-1" style="padding : 10px;">
            <div class="row">
                <div class="col s12 m12 l12">
                    <p>{{session('msg')['content']}}</p>
                </div>
            </div>
        </div>
    @endisset
    <div class="container" style="padding : 20px 0;">
        <div class="row">
            <div class="center-align col s12">
                <h3>New Student</h3>
            </div>
            <form method="post" action="/register">
                @csrf
                <div class="input-field col s6">
                    <input placeholder="Full Name" name="full_name" id="full_name" type="text" class="validate">
                    <label for="full_name">Full Name</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Student ID" name='student_id' id="student_id" type="text" class="validate">
                    <label for="student_id">Student ID</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Date of Birth" name="date_of_birth" id="date_of_birth" type="date" class="validate">
                    <label for="date_of_birth">Date of Birth</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder="Address" name="address" id="address" type="text" class="validate">
                    <label for="address">Address</label>
                </div>
                <div class="center-align col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="register">Register
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
@endsection