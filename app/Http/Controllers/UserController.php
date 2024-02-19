<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy(User $user){

        if($user->driver()->first()->exists()){
            $user->driver()->first()->delete();
        } elseif ($user->passenger()->first()->exists()) {
            $user->passenger()->first()->delete();
        } elseif($user->admin()->first()->exists()) {
            $user->admin()->first()->delete();
        }

        $user->delete();

        return back();
    }
}
