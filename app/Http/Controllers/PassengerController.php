<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
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
                ->latest()
                ->paginate(5),

            'currentReservation' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ],
                'review'
            ])->where('passenger_id', auth()->user()->passenger()->first()->id)
                ->where('date', '<=', now()->timezone('Africa/Casablanca')->toDateTimeString())
                ->doesntHave('review')
                ->orderBy('date', 'DESC')
                ->first(),

            'favorites' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ],
                'review'
            ])->where('favorited', '1')
                ->latest()
                ->distinct()
                ->get(),

            'ratings' => Driver::join('driver_route', 'driver_route.driver_id', 'drivers.id')
                                ->join('reservations', 'reservations.route_id', 'driver_route.id')
                                ->join('reviews', 'reviews.reservation_id', 'reservations.id')
                                ->get(),

            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }

    public function reservations() {
        return view('/passenger/reservations', [
            'reservations' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ]
            ])->where('passenger_id', auth()->user()->passenger()->first()->id)
                ->latest()
                ->paginate(5),

            'favorites' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ],
                'review'
            ])->where('favorited', '1')
                ->latest()
                ->distinct()
                ->get(),
        ]);
    }

    public function routes() {
        return view('/passenger/routes', [
            'reservations' => Reservation::with([
                'route' => [
                    'driver',
                    'route'
                ]
            ])->where('passenger_id', auth()->user()->passenger()->first()->id)
                ->latest()
                ->paginate(5)
        ]);
    }
}
