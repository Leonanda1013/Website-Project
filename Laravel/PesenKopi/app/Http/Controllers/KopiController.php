<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KopiModel;

class KopiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kopi = KopiModel::all();
        return view('kopi.index', compact('kopi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kopi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kopi' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);

        KopiModel::create($validated);

        return redirect()->route('kopi.index')
                         ->with('success', 'Kopi berhasil ditambahkan!');
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
