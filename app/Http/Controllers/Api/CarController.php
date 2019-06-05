<?php

namespace App\Http\Controllers\Api;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CarController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$cars = Car::with('reviews')->get();
		return response()->json(['cars' => $cars]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$data = $request->all();
		$rules = [
			'make' => 'required|unique:cars',
			'model' => 'required|unique:cars',
			'produced_on' => 'required|date_format:Y-m-d'
		];
		$messages = [
			'unique' => 'Provided :attribute already exists',
			'produced_on.date' => 'Enter a valide production date'
		];
		Validator::make($data, $rules, $messages)->validate();

		$car = new Car($data);
		$car->save();
		$car = Car::with('reviews')->findOrFail($car->id);
		return response()->json(['car' => $car]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$car = Car::with('reviews')->findOrFail($id);
		return response()->json(['car' => $car]);
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
		$rules = [
			'make' => [
				'required',
				Rule::unique('cars')->ignore($id)
			],
			'model' => [
				'required',
				Rule::unique('cars')->ignore($id)
			],
			'produced_on' => 'required|date_format:Y-m-d'
		];
		$messages = [
			'unique' => 'Provided :attribute already exists',
		];
		Validator::make($data, $rules, $messages)->validate();

		$car = Car::with('reviews')->findOrFail($id);
		$car->fill($data);
		$car->save();
		return response()->json(['car' => $car]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$car = Car::findOrFail($id);
		$car->delete();
		return response()->json(['success' => 'Record deleted']);
	}
}
