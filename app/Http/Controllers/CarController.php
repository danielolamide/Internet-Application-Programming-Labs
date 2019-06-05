<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
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
		$cars = Car::all();
		return view('cars.index', ['cars' => $cars]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('cars.create');
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
			'produced_on' => 'required|date'
		];
		$messages = [
			'unique' => 'Provided :attribute already exists',
			'produced_on.date' => 'Enter a valide production date'
		];
		Validator::make($data, $rules, $messages)->validate();

		$car = new Car($data);
		$car->save();
		return redirect('/cars');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$car = Car::findOrFail($id);
		return view('cars.car', ['car' => $car]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$car = Car::findOrFail($id);
		return view('cars.edit', ['car' => $car]);
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
			'produced_on' => 'required|date'
		];
		$messages = [
			'unique' => 'Provided :attribute already exists',
			'produced_on.date' => 'Enter a valide production date'
		];
		Validator::make($data, $rules, $messages)->validate();

		$car = Car::findOrFail($id);
		$car->fill($data);
		$car->save();
		return redirect('/cars');
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
		return redirect('/cars');
	}
}
