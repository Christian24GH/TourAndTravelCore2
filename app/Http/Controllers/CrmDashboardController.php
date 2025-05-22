<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrmDashboardController extends Controller
{
    public function index()
    {
        // KPI counts
        $totalCustomers        = DB::table('customers')->count();
        $totalNotes            = DB::table('customer_notes')->count();
        $totalCommunications   = DB::table('customer_communications')->count();
        $totalOpenIssues       = DB::table('customer_issues')
                                    ->where('status', 'open')
                                    ->count();

        // Recent 5 communications
        $recentCommunications = DB::table('customer_communications')
            ->join('customers', 'customer_communications.customer_id', '=', 'customers.id')
            ->select(
                'customer_communications.*',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name")
            )
            ->orderByDesc('customer_communications.communicated_at')
            ->limit(5)
            ->get();

        // Recent 5 open issues
        $recentIssues = DB::table('customer_issues')
            ->join('customers', 'customer_issues.customer_id', '=', 'customers.id')
            ->select(
                'customer_issues.*',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name")
            )
            ->where('customer_issues.status', 'open')
            ->orderByDesc('customer_issues.created_at')
            ->limit(5)
            ->get();

        // Recent 5 notes
        $recentNotes = DB::table('customer_notes')
            ->join('customers', 'customer_notes.customer_id', '=', 'customers.id')
            ->select(
                'customer_notes.*',
                DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) AS customer_name")
            )
            ->orderByDesc('customer_notes.created_at')
            ->limit(5)
            ->get();

        return view('crm.dashboard.index', compact(
            'totalCustomers',
            'totalNotes',
            'totalCommunications',
            'totalOpenIssues',
            'recentCommunications',
            'recentIssues',
            'recentNotes'
        ));
    }
}
