<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class RouteController extends Controller
{
    public function store(Request $request){

        // dd($request);

        $attributes = $request->validate([
            'departure' => 'required',
            'destination' => 'required'
        ]);

        $route = Route::where('departure', $attributes['departure'])->where('destination', $attributes['destination'])->first();

        if($route === null) {
            $attributes = array_merge($attributes, [
                'driver_id' => auth()->user()->driver()->get()[0]->id
            ]);
    
            Route::create($attributes);
        } else {
            $route = Route::find($route->id);

            $route->created_at = now();

            $route->save();
        }

        

        return redirect('driver/dashboard')->with('success', 'Current route changed successfully');
    }
}
