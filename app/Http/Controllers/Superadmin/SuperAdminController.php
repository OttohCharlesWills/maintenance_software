<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Meter;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
       $admins = User::where('role','admin')->count();

        $operators = User::where('role','operator')->count();

        $locations = Location::count();

        $machines = Machine::count();


        $running = Machine::where('status','running')->count();

        $standby = Machine::where('status','standby')->count();

        $shutdown = Machine::where('status','shutdown')->count();

        $faulty = Machine::where('status','faulty')->count();
        
        $recentUsers = User::with('location')
                    ->latest()
                    ->take(5)
                    ->get();

        $recentLogs = Meter::with('machine')
                    ->latest()
                    ->take(5)
                    ->get();


        return view('superadmin.dashboard', compact(
            'admins',
            'operators',
            'locations',
            'machines',
            'running',
            'standby',
            'shutdown',
            'faulty',
            'recentUsers',
            'recentLogs'
        ));
   }

}