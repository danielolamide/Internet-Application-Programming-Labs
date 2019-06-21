<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model{
    protected $primaryKey = "id";
    public function students(){
        return $this->belongsTo('App\Student',"id","id");
    }
}
