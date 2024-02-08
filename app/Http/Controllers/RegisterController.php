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
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255'
        ]);

        if($request->input('role') === 'passenger') {

            $request->validate([
                'phone' => 'required|numeric'
            ]);

            $user = User::create($attributes);

            $passenger = new Passenger;
            $passenger->phone = $request->input('input');
            $passenger->user_id = $user->id;
            $passenger->save();

        } elseif ($request->input('role') === 'driver') {

            $driverAttributes = $request->validate([
                'description' => 'required|max:255',
                'registration' => 'required|max:255',
                'typeVehicle' => 'required|max:255',
                'typePayment' => 'required|max:255',
            ]);

            $user = User::create($attributes);

            $driverAttributes = array_merge($driverAttributes, [
                'user_id' => $user->id
            ]);

            Driver::create($driverAttributes);

        }
    }

}
