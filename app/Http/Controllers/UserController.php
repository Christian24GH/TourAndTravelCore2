<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function home()
    {
        $id = session('userid');
        $customer = DB::table('customers')->where('id', $id)->first();
        return view('crm.user.index', compact('customer'));
    }

    public function schedule()
    {
        $schedules = DB::table('schedules')->get();
        return view('crm.user.schedule', compact('schedules', 'id'));
    }

    public function schedule_store(Request $request, $id)
    {
        // Logic for booking schedules (if needed)
    }

    public function schedule_destroy($id, $scheduleId)
    {
        // Logic for cancelling/deleting schedules (if needed)
    }

    public function application($id)
    {
        $applications = DB::table('application')
            ->where('customerID', $id)
            ->get();

        return view('crm.user.application', compact('applications', 'id'));
    }

    public function application_store(Request $request, $id)
    {
        // Logic for submitting applications
    }

    public function application_destroy($id, $applicationId)
    {
        DB::table('application')->where('applicationID', $applicationId)->delete();
        return redirect()->route('user.application.index', $id);
    }
}
