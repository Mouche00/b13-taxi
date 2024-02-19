<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin/index', [
            'drivers' => [
                'deleted' => Driver::onlyTrashed()->count(),
                'all' => Driver::all()->count(),
                'available' => Driver::all()->where('available', '1')->count(),
                'unavailable' => Driver::all()->where('available', '0')->count()
            ],

            'passengers' => [
                'deleted' => Passenger::withTrashed()->count(),
                'all' => Passenger::all()->count()
            ],

            'reservations' => [
                'deleted' => Reservation::onlyTrashed()->count(),
                'all' => Reservation::all()->count(),
                'reviewed' => Reservation::has('review')->count(),
                'favorited' => Reservation::where('favorited', '1')->count()
            ],
        ]);
    }

    public function reservations() {

        return view('admin/reservations', [

            'reservations' => Reservation::with([
                'route' => [
                    'driver' => [
                        'user'
                    ],
                    'route'
                ], 'passenger' => [
                    'user'
                ]
            ])->latest()
                ->get(),
        ]);
    }

    public function users() {

        return view('admin/users', [

            'users' => User::with([
                'driver',
                'passenger',
                'admin'
            ])->get()
        ]);
    }
}
