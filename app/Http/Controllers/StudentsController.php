<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Carbon\Carbon;

class StudentsController extends Controller
{
    public function register(Request $request){
        $today_date = Carbon::now();
        $customMessages =[
            'date_of_birth.before_or_equal' => "Date of birth cannot be in the future",
            'student_id.unique' => 'Student ID already exists'
        ];
        $this->validate($request, [
            'student_id' => "required|unique:students",
            'full_name' => "required",
            'date_of_birth' => 'required|date|before_or_equal:'.$today_date,
            'address' => 'required'
        ],$customMessages);

        $student = new Student();
        $student->student_id = request('student_id');
        $student->fullname = request('full_name');
        $student->dob = request('date_of_birth');
        $student->address = request('address');
        $student->save();
        return redirect('/register')->with('msg', ['type'=>'success','content' => 'Student added successfully']);
        
    }
    public function find(Request $request){
        $this->validate($request,[
            'student_id' => 'required|exists:students'
        ],[
            "student_id.exists" => "Enter a valid Student ID"
        ]);
        // $searchQuery = request('student_id');
        $student = Student::where('student_id',request('student_id'))->firstOrFail();
        return view('pages.search',['student' => $student, 'title'=>'Search']);

    }
}
