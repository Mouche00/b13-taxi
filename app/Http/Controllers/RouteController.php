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

        $attributes = array_merge($attributes, [
            'driver_id' => auth()->user()->driver()->get()[0]->id
        ]);

        Route::create($attributes);

        return redirect('driver/dashboard')->with('success', 'Current route changed successfully');
    }
}
