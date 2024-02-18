<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Driver;

class RouteController extends Controller
{
    public function store(Request $request){

        // dd($request);

        $attributes = $request->validate([
            'departure' => 'required',
            'destination' => 'required'
        ]);

        $date = $request->validate([
            'date' => 'required|date|before:' . now()->addMonth()->toDateTimeString() . '|after:' . now()->toDateTimeString()
        ]);

        $route = Route::where('departure', $attributes['departure'])->where('destination', $attributes['destination'])->first();
        $id = auth()->user()->driver()->first()->id;
        $driver = Driver::find($id);

        $currentRoute = $driver->routes()->wherePivot('selected', 1)->first();

        if($currentRoute){

            $driver->routes()->updateExistingPivot($currentRoute->id, ['selected' => '0']);
        }

        if($route === null) {
    
            $route = Route::create($attributes);
        }

        if($driver->routes()->find($route->id)){

            $route->drivers()->updateExistingPivot($id, ['selected' => 1, 'date' => $request->input('date')]);
        }else{

            $route->drivers()->attach($id, ['selected' => 1, 'date' => $request->input('date')]);
        }

        

        return redirect('driver/dashboard')->with('success', 'Current route changed successfully');
    }
}
