<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Carbon;

class PassengerController extends Controller
{
    public function index(){

        request()->validate([
            'date' => 'date|after:' . now()->toDateTimeString()
        ]);

        $date = request('date');

        return view('passenger.index', [
            'drivers' => Driver::whereHas( 'currentRoute', fn($query) => 
                $query->where('driver_route.date', '>=', $date ?? Carbon::create('3000')->toDateString())
            )->latest()
                ->where('available', 1)
                ->filter(['departure' => request(['departure']), 'destination' => request(['destination'])])
                ->paginate(20),

            'reservations' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ]
            ])->where('passenger_id', auth()->user()->passenger()->first()->id)
                ->get(),

            'currentReservation' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ],
                'review'
            ])->where('passenger_id', auth()->user()->passenger()->first()->id)
                ->where(''),

            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }
}
