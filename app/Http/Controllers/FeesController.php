<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fee;
use App\Student;
use Illuminate\Support\Facades\DB;



class FeesController extends Controller
{
    public function payFees(Request $request){
       $this->validate($request,[
            'student_id' => 'required|exists:students',
            'date_of_payment' => 'required',
            'payment_amount' => 'required'
       ],[
           'student_id.exists'=> 'Enter a valid Student Number'
       ]);

       $fee = new Fee();
       $fee->student_id = request('student_id');
       $fee->payment_date = request('date_of_payment');
       $fee->amount_paid = request('payment_amount');
       $fee->save();
       return redirect('/fees')->with('msg', ['type'=>'success','content' => 'Payment added successfully']);

    }
    public function payments(){
        $title = "Payments";
        $students = Student::has('fees')->withCount([
			'fees as total' => function ($query) {
				$query->select(DB::raw('sum(amount_paid)'));
			}
		])->get();
        return view('pages.payments',['title' =>$title, 'students'=>$students]);
    }
}
