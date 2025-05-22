<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Rates extends Controller
{
    public function index()
    {
        
        $rates = DB::table('rates')->get();
        
        return view('sr.rates', ['rates'=>$rates]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'multiplier' => 'numeric|max:999.99',
        ]);
        
        //dd($request);
        DB::table('rates')->insert([
            'rate_name' => $request->rate_name,
            'multiplier' => $request->multiplier,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Rate added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'multiplier' => 'numeric|max:999.99',
        ]);
        //dd($request);
        DB::table('rates')->where('id', $id)->update([
            'rate_name' => $request->rate_name,
            'multiplier' => $request->multiplier,
            'description' => $request->description,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Rate updated successfully!');
    }
    public function destroy($id)
    {
        //dd($id);
        DB::table('rates')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Rate deleted successfully!');
    }
}
