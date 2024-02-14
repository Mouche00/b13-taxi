<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassengerController extends Controller
{
    public function index(){
        dd(auth()->user()->role);
    }
}
