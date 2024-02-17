<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index() {
        $id = auth()->user()->driver()->first()->id;

        return view('driver.index', [
            'routes' => Driver::find($id)->routes()->wherePivot('selected', '0')->orderBy('created_at', 'DESC')->paginate(5),
            'currentRoute' => Driver::find($id)->currentRoute()->first(),
            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }
}
