<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudySchedule;

class StudyScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilakn Semua jadwal
        $schedules = StudySchedule::orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //GET /schedules/create - tampilkan form tambah
        return view('schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // POST /schedules - simpan data baru ke DB
        // Validasi input
        $validate = $request->validate([
            'subject' => 'requered|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'requered',
            'end_time' => 'requered',
            'day_of_week' => 'requered|in:monday,tuesday,wednesday,thrusday,friday,saturday,sunday',
            'color' => 'nullable|string'
        ]);

        StudySchedule::create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // GET /schedules/{id} - tampilkan detail jadwal
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // GET /schedules/{id}/edit -tampilkan form edit
        // Laravel otomatis cari data by ID (ROute Model Binding)
        return view('schedules.edit', compact('schedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudySchedule $schedule)
    {
        // PUT /schedules/{id} - simpan hasil edit
        $validate = $request->validate([
            'subject' => 'requered|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'requered',
            'end_time' => 'requered',
            'day_of_week' => 'requered|in:monday,tuesday,wednesday,thrusday,friday,saturday,sunday',
            'color' => 'nullable|string'
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudySchedule $schedule)
    {
        // DELETE /schedules/{id} - hapus data
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil dihapus!');

    }
}
