<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $fillable = ['review'];
	protected $primaryKey = 'review_id';

	function car() {
		return $this->belongsTo('App\Car');
	}
}
