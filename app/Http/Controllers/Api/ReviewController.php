<?php

namespace App\Http\Controllers\Api;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($car)
	{
		// ? Show all reviews of a car
		$car = Car::findOrFail($car);
		return response()->json(['reviews' => $car->reviews()->get()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, $car_id)
	{
		$data = $request->all();
		Validator::make($data, [
			'review' => 'required'
		], [
			'review.required' => 'Review can\'t be empty'
		])->validate();
		$car = Car::findOrFail($car_id);
		$review = new Review($data);
		$car->reviews()->save($review);
		return response()->json(['reviews' => $car->reviews()->get()]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$review = Review::with('car')->findOrFail($id);
		return response()->json(['review' => $review]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$data = $request->all();
		Validator::make($data, [
			'review' => 'required'
		], [
			'review.required' => 'Review can\'t be empty'
		])->validate();
		$review = Review::findOrFail($id);
		$review->review = $data['review'];
		$review->save();
		$review->load('car');
		return response()->json(['review' => $review]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$review = Review::findOrFail($id);
		$review->delete();
		return response()->json(['success' => 'Record deleted']);
	}
}
