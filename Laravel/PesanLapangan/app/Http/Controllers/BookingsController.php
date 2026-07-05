<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Court;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courts = Court::all();
        return view('bookings.create', compact('courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'court_id' => 'required|exists:court,id',
            'customer_name'=> 'required|string|max:255',
            'booking_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
        ]);
        $end_time = date('H:i', strtotime($request->start_time . ' + 1 hour'));
        $isBookingExists = Booking::where('court_id', $request->court_id)
            ->where('booking_date', $request->booking_date)
            ->where(function ($query) use ($request, $end_time) {
                $query->whereBetween('start_time', [$request->start_time, $end_time])
                      ->orWhere('status','!==','cancelled')
                      ->orWhere(function ($query) use ($request, $end_time) {
                          $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $end_time);
                      });
            })
            ->exists();
        if ($isBookingExists) {
            return redirect()->back()->withErrors(['error' => 'The selected time slot is already booked. Please choose a different time.'])->withInput();
        }
        Booking::create(array_merge($request->all(), ['end_time' => $end_time]));

        return redirect()->route('bookings.index')
                         ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
