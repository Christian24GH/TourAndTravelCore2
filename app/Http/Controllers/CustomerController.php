<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // List all customers
    public function index()
    {
        $customers = DB::table('customers')->get();
        return view('crm.customers.index', compact('customers'));
    }

    // Show create form
    public function create()
    {
        return view('crm.customers.create');
    }

    // Store new customer
    public function store(Request $request)
    {
        DB::table('customers')->insert([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'notes'         => $request->notes,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect()->route('crm.customers.index')->with('success', 'Customer added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        return view('crm.customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, $id)
    {
        DB::table('customers')->where('id', $id)->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'notes'         => $request->notes,
            'updated_at'    => now(),
        ]);

        return redirect()->route('crm.customers.index')->with('success', 'Customer updated successfully.');
    }

    // Delete customer
    public function destroy($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        return redirect()->route('crm.customers.index')->with('success', 'Customer deleted successfully.');
    }
}
