<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerNoteController extends Controller
{
    // List all notes (with customer names)
    public function index()
    {
        $notes = DB::table('customer_notes')
            ->join('customers', 'customer_notes.customer_id', '=', 'customers.id')
            ->select('customer_notes.*', DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name"))
            ->orderBy('customer_notes.created_at', 'desc')
            ->get();

        $customers = DB::table('customers')->get(); // for the add form dropdown

        return view('crm.notes.index', compact('notes', 'customers'));
    }

    // Store a new note
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'note'        => 'required|string',
        ]);

        DB::table('customer_notes')->insert([
            'customer_id' => $request->customer_id,
            'note'        => $request->note,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('crm.notes.index')->with('success', 'Note added successfully.');
    }

    // Delete a note
    public function destroy($id)
    {
        DB::table('customer_notes')->where('id', $id)->delete();
        return redirect()->route('crm.notes.index')->with('success', 'Note deleted.');
    }
}
