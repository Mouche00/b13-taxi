<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function create()
    {
        return view('register.create');
    }

    public function store(Request $request)
    {
        $attributes = array_merge($request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255',
            'picture' => 'required|image'
        ]), ['picture' => $request->file('picture')->store('uploads')]);

        if($request->input('role') === 'passenger') {

            $request->validate([
                'phone' => 'required|numeric'
            ]);

            $user = User::create($attributes);

            $passenger = new Passenger;
            $passenger->phone = $request->input('phone');
            $passenger->user_id = $user->id;
            $passenger->save();

        } elseif ($request->input('role') === 'driver') {

            $user = User::create($attributes);

            $request->validate([
                'description' => 'required|max:255',
                'registration' => 'required|max:255',
                'typeVehicle' => 'required|max:255',
                'typePayment' => 'required|max:255',
            ]);

            $driver = new Driver;
            $driver->description = $request->input('description');
            $driver->registration = $request->input('registration');
            $driver->typeVehicle = $request->input('typeVehicle');
            $driver->typePayment = $request->input('typePayment');
            $driver->user_id = $user->id;
            $driver->save();

        }
        return redirect('/login');
    }

}
