<?php

namespace App\Http\Controllers;

use App\Models\DailyActivity;
use Illuminate\Http\Request;

class DailyActivityController extends Controller
{
    // GET /activities → tampilkan kegiatan hari ini
    public function index()
    {
        $today = today(); // helper Laravel, sama dengan Carbon::today()

        $activities = DailyActivity::whereDate('date', $today)
                                   ->orderBy('time')
                                   ->get();

        // Hitung statistik untuk header
        $stats = [
            'total' => $activities->count(),
            'done'  => $activities->where('status', 'done')->count(),
            'skip'  => $activities->where('status', 'skip')->count(),
        ];

        return view('activities.index', compact('activities', 'stats'));
    }

    // GET /activities/create → form tambah kegiatan
    public function create()
    {
        return view('activities.create');
    }

    // POST /activities → simpan kegiatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'note'  => 'nullable|string',
            'date'  => 'required|date',
            'time'  => 'nullable',
        ]);

        // Kalau tidak diisi, default status = pending
        $validated['status'] = 'pending';

        DailyActivity::create($validated);

        return redirect()->route('activities.index')
                         ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // PATCH /activities/{id}/toggle → ganti status
    public function toggle(DailyActivity $activity)
    {
        // Urutan siklus status: pending → done → skip → pending → ...
        $nextStatus = [
            'pending' => 'done',
            'done'    => 'skip',
            'skip'    => 'pending',
        ];

        $activity->update([
            'status' => $nextStatus[$activity->status]
        ]);

        return redirect()->route('activities.index');
    }

    // DELETE /activities/{id} → hapus kegiatan
    public function destroy(DailyActivity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')
                         ->with('success', 'Kegiatan dihapus!');
    }
}
