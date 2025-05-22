<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerIssueController extends Controller
{
    public function index()
    {
        $issues = DB::table('customer_issues')
            ->join('customers', 'customer_issues.customer_id', '=', 'customers.id')
            ->select(
                'customer_issues.*',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name")
            )
            ->orderByDesc('customer_issues.created_at')
            ->get();

        return view('crm.issues.index', compact('issues'));
    }

    public function create()
    {
        $customers = DB::table('customers')->get();
        return view('crm.issues.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:open,in_progress,resolved,closed',
        ]);

        DB::table('customer_issues')->insert([
            'customer_id' => $request->customer_id,
            'subject'     => $request->subject,
            'description' => $request->description,
            'status'      => $request->status,
            'handled_by'  => null, // Default for now
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('crm.issues.index')->with('success', 'Issue submitted.');
    }

    public function edit($id)
    {
        $issue = DB::table('customer_issues')->where('id', $id)->first();
        $customers = DB::table('customers')->get();

        return view('crm.issues.edit', compact('issue', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'subject'     => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:open,in_progress,resolved,closed',
        ]);

        DB::table('customer_issues')->where('id', $id)->update([
            'customer_id' => $request->customer_id,
            'subject'     => $request->subject,
            'description' => $request->description,
            'status'      => $request->status,
            'updated_at'  => now(),
        ]);

        return redirect()->route('crm.issues.index')->with('success', 'Issue updated.');
    }

    public function destroy($id)
    {
        DB::table('customer_issues')->where('id', $id)->delete();
        return redirect()->route('crm.issues.index')->with('success', 'Issue deleted.');
    }
}
