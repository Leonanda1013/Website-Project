<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // Nanti data dari DB masuk sini
        // Ini pakai dummy terlebih dahulu
        $stats = [
            'jadwal_hari_ini' => 3,
            'kegiatan_selesai' => 2,
            'total_kegiatan' => 5,
            'saldo' => 450000,
        ];

        // kirim data ke View
        return view('dashboard', compact('stats'));
    }
}
