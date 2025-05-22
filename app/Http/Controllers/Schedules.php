<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Schedules extends Controller
{
    public function index()
    {
        $tourPackages = DB::table('tour_packages')->get();
        $rates = DB::table('rates')->get();
        $schedules = DB::table('schedules')
                    ->join('tour_packages', 'schedules.tour_package_id', '=', 'tour_packages.id')
                    ->select('schedules.*', 'tour_packages.title as tour_title')
                    ->get();
        return view('sr.schedule', ['tourPackages'=>$tourPackages, 'rates'=>$rates, 'schedules'=>$schedules]);
    }

    public function store(Request $request)
    {   
        // Validate the incoming request
        $validator =  $request->validate([
            'tour_package_id' => 'required|integer|exists:tour_packages,id',
            'rate_id'         => 'required|integer|exists:rates,id',
            'start_date'      => 'required|date|after_or_equal:today',
            'start_time'      => 'required|date_format:H:i',
            'duration'        => 'required|integer|min:1',
            'location'        => 'required|string|max:255',
            'final_price'     => 'required|numeric|min:0',
            'status'          => 'required|in:pending,confirmed,cancelled,completed',
        ]);
        
        DB::table('schedules')->insert([
            'tour_package_id' => $request->tour_package_id,
            'rate_id' => $request->rate_id,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'location' => $request->location,
            'final_price' => $request->final_price,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Schedule added successfully!');
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        DB::table('schedules')->where('id', $id)->update([
            'rate_id' => $request->rate_id,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'duration' => $request->duration,
            'final_price' => $request->final_price,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }
    public function destroy($id)
    {
        DB::table('schedules')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Schedule deleted successfully!');
    }
}
