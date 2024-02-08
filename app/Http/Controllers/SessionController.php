<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Driver;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(! auth()->attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        if (sizeof(Passenger::where('user_id', auth()->id())->get()) > 0){
            return redirect('/passenger');
//            dd(Passenger::where('user_id', auth()->id()));
        } elseif (sizeof(Driver::where('user_id', auth()->id())->get()) > 0){
            return redirect('/driver');
        } elseif (sizeof(Admin::where('user_id', auth()->id())->get()) > 0) {
            return redirect('/admin');
        }
    }

    public function destroy(){
        auth()->logout();

        return redirect('/');
    }
}
