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
    @error('date_of_payment')
    <div class="container grey lighten-5 red-text text-darken-1" style ="margin-bottom : 10px; padding: 10px;">
        <div class="row">
            <div class="col s12 m12 l12">
                {{ $message }}
            </div>
        </div>
    </div>
    @enderror
    @error('payment_amount')
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
    <div class="container" style = "padding : 20px 0;">
        <div class="row">
            <div class=" center-align col s12">
                <h3>Pay Fees</h3>
            </div>
            <form method="post" action="/fees">
                @csrf
                <div class="input-field col s12">
                    <input placeholder="Student ID" name='student_id' id="student_id" type="text" class="validate">
                    <label for="student_id">Student ID</label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="Date of Payment" name="date_of_payment" id="date_of_payment" type="date" class="validate">
                    <label for="date_of_payment">Date of Payment</label>
                </div>
                <div class="input-field col s12">
                        <input placeholder="Payment Amount" name='payment_amount' id="payment_amount" type="number" class="validate">
                        <label for="payment_amount">Payment Amount</label>
                    </div>
                <div class="center-align col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="pay_fees">Pay Fees
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
@endsection