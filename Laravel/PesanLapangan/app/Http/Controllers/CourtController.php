<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Type_Court;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courts = Court::all();
        return view('courts.index', compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courtTypes = Type_Court::all();
        return view('courts.create', compact('courtTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'type_court_id' => 'required|exists:type_court,id',
            'price' => 'required|integer|min:0',
        ]);

        Court::create($validate);
        return redirect()->route('courts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $court = Court::findOrFail($id);
        return view('courts.show', compact('court'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $court = Court::findOrFail($id);
        $courtTypes = Type_Court::all();
        return view('courts.edit', compact('court', 'courtTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $court = Court::findOrFail($id);
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'type_court_id' => 'required|exists:type_court,id',
            'price' => 'required|integer|min:0',
        ]);

        $court->update($validate);
        return redirect()->route('courts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $court = Court::findOrFail($id);
        $court->delete();
        return redirect()->route('courts.index');
    }
}
