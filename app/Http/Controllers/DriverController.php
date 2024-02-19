<?php

namespace App\Http\Controllers;

use App\Models\DriverRoute;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index() {
        $id = auth()->user()->driver()->first()->id;

        return view('driver.index', [
            'routes' => Driver::find($id)->routes()->wherePivot('selected', '0')->orderBy('created_at', 'DESC')->paginate(5),
            'currentRoute' => Driver::find($id)->currentRoute()->first(),
            // 'reservedFlag' => DriverRoute::has('reservation')->where('driver_id', $id)->exists(),
            'cities' => json_decode(file_get_contents('https://raw.githubusercontent.com/alaouy/sql-moroccan-cities/master/json/ville.json'))
        ]);
    }

    public function update(Driver $driver){
        if($driver->available){

            $driver->available = '0';
            $driver->save();
        } else {

            $reservations = $driver->currentRoute()->first()->reservation()->where('date', '>=', now()->timezone('Africa/Casablanca')->format('Y-m-d\Th:i'))->get();
            $driver->available = '1';

            foreach($reservations as $reservation){
                if(now()->timezone('Africa/Casablanca')->addHour()->format('Y-m-d\Th:i') < $reservation->date){

                    $reservation->delete();
                    
                } else {

                    $driver->available = '0';
                }
            }

            $driver->save();
            
            
        }

        return back();
    }

    public function reservations() {

        return view('/driver/reservations', [
            'reservations' => Reservation::with([
                'route' => [
                    'route',
                    'driver'
                ], 'passenger'
            ])->latest()
                ->get()
        ]);
    }
}
