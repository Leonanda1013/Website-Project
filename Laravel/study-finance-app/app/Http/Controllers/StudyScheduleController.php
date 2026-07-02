<?php

namespace App\Http\Controllers;

use App\Models\StudySchedule;
use Illuminate\Http\Request;

class StudyScheduleController extends Controller
{
    // GET /schedules → tampilkan semua jadwal
    public function index()
    {
        $schedules = StudySchedule::where('user_id', auth()->id())
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();

        return view('schedules.index', compact('schedules'));
    }

    // POST /schedules → simpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject'     => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time'  => 'required|date_format:H:i',
            'end_time'    => 'required|date_format:H:i|after:start_time',
            'day_of_week' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'color'       => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        StudySchedule::create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // PUT /schedules/{id} → update jadwal
    public function update(Request $request, StudySchedule $schedule)
    {
        // Pastikan hanya pemilik yang bisa edit
        $this->authorize('update', $schedule); // pakai Policy (opsional)
        // atau manual:
        abort_if($schedule->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'subject'    => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
            'day_of_week'=> 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil diupdate!');
    }

    // DELETE /schedules/{id}
    public function destroy(StudySchedule $schedule)
    {
        abort_if($schedule->user_id !== auth()->id(), 403);
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal dihapus!');
    }
}
