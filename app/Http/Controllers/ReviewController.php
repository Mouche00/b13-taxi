<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $attributes = $request->validate([
            'rating' => 'required|numeric|integer|gte:1|lte:5'
        ]);

        $reservation = Reservation::find($request->input('reservation_id'));

        $reservation->review()->create($attributes);

        return back()->with('success', 'Review added successfully');
    }
}
