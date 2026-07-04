<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Books;
use App\Models\Member;

class BorrowsController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['book', 'member'])->get();
        return view('borrows.index', compact('borrows'));
    }

    public function create()
    {
        $books = Books::all();
        $members = Member::all();
        return view('borrows.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
        ]);
        $returnDate = date('Y-m-d', strtotime($validated['borrow_date'] . ' +7 days'));
        $validated['return_date'] = $returnDate;

        Borrow::create($validated);

        return redirect()->route('borrows.index')
                         ->with('success', 'Borrow record created successfully.');
    }
}
