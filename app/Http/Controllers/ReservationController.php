<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverRoute;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request){

        $attributes = $request->validate([
            'date' => 'required|date|after:' . now()->toDateTimeString(),
            'route_id' => 'required'
        ]);

        $attributes = array_merge($attributes, ['passenger_id' => auth()->user()->passenger()->first()->id]);

        Reservation::create($attributes);

        $route = DriverRoute::find($attributes['route_id']);
        $driver = Driver::find($route->driver_id);
        $driver->available = '0';
        $driver->save();

        // Reservation::create($attributes)->route()->save(auth()->user()->passenger()->first());

        return redirect('/passenger/dashboard')->with('success', 'Reservation added successfully');
    }
}
