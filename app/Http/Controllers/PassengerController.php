<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class PassengerController extends Controller
{
    public function index(){

        return view('passenger.index', [
            'drivers' => Driver::with('currentRoute')->latest()->filter(['departure' => request(['departure']), 'destination' => request(['destination'])])->paginate(20),
            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }
}
