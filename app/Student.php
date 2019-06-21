<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{
    protected $primaryKey = 'student_id';
    
    public function fees(){
        return $this->hasMany("App\Fee","student_id","student_id");
    }
}

