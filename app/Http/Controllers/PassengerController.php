<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class PassengerController extends Controller
{
    public function index(){

        return view('passenger.index', [
            'routes' => Route::with('driver')->latest()->filter(request(['departure', 'destination']))->paginate(5),
            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }
}
