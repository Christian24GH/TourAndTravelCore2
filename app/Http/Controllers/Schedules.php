<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Schedules extends Controller
{
    public function index()
    {
        $tourPackages = DB::table('tours')->get();
        $rates = DB::table('rates')->get();
        $schedules = DB::table('tour_schedules')
                    ->join('tours', 'tour_schedules.tour_id', '=', 'tours.id')
                    ->select('tour_schedules.*', 'tours.title')
                    ->get();
        return view('sr.schedule', ['tourPackages'=>$tourPackages, 'rates'=>$rates, 'schedules'=>$schedules]);
    }

    public function store(Request $request)
    {   
        // Validate the incoming request
        $validator =  $request->validate([
            'tour_id'        => 'required|integer|exists:tours,id',
            'rate_id'         => 'required|integer|exists:rates,id',
            'start_date'      => 'required|date|after_or_equal:today',
            'start_time'      => 'required|date_format:H:i',
            'tour_guide'      => 'required|string|max:255',
            'vehicle_assigned'=> 'required|string|max:255',
            'max_participant' => 'required|numeric|min:0',
            'status'          => 'required',
        ]);
        try{

            DB::table('tour_schedules')->insert([
                'tour_id' => $request->tour_id,
                'rate_id' => $request->rate_id,
                'tour_date' => $request->start_date,
                'tour_time' => $request->start_time,
                'tour_guide' => $request->tour_guide,
                'vehicle_assigned' => $request->vehicle_assigned,
                'max_participants' => $request->max_participant,
                'status' => $request->status,
            ]);
            return redirect()->back()->with('success', 'Schedule added successfully!');
        }catch(\Exception $e){
            return redirect()->back()->with('errors', $e);
        };
    
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        DB::table('tour_schedules')->where('id', $id)->update([
            'rate_id' => $request->rate_id,
            'tour_date' => $request->tour_date,
            'tour_time' => $request->tour_time,
            'tour_guide' => $request->tour_guide,
            'max_participants' => $request->max_participants,
            'vehicle_assigned' => $request->vehicle_assigned,
            'status' => $request->status,
            
        ]);

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }
    public function destroy($id)
    {
        DB::table('tour_schedules')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Schedule deleted successfully!');
    }
}
