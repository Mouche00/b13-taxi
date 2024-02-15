<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;

class DriverController extends Controller
{
    public function index() {
        return view('driver.index', [
            'routes' => Route::latest()->where('driver_id', auth()->user()->driver()->get()[0]->id)->paginate(5),
            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }
}
