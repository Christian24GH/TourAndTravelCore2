<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunicationLogController extends Controller
{
    public function index()
    {
        $logs = DB::table('communication_logs')
            ->join('customers', 'communication_logs.customer_id', '=', 'customers.id')
            ->select('communication_logs.*', DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name"))
            ->orderBy('communication_logs.created_at', 'desc')
            ->get();

        $customers = DB::table('customers')->get();

        return view('crm.logs.index', compact('logs', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'type'        => 'required|string|max:255',
            'content'     => 'required|string',
        ]);

        DB::table('communication_logs')->insert([
            'customer_id' => $request->customer_id,
            'type'        => $request->type,
            'content'     => $request->content,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('crm.logs.index')->with('success', 'Communication log added.');
    }

    public function destroy($id)
    {
        DB::table('communication_logs')->where('id', $id)->delete();
        return redirect()->route('crm.logs.index')->with('success', 'Log deleted.');
    }
}
