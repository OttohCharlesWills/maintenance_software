<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Meter;

class AdminController extends Controller
{
public function dashboard()
{
    $admin = Auth::user();

    // Assuming users have a location_id column
    $locationId = $admin->location_id;

    // Only operators in this admin's location
    $operators = User::where('role', 'operator')
        ->where('location_id', $locationId)
        ->count();

    // Machines in this location
    $machines = Machine::where('location_id', $locationId)->count();

    // Machine status counts
    $running = Machine::where('location_id', $locationId)
        ->where('status', 'running')
        ->count();

    $standby = Machine::where('location_id', $locationId)
        ->where('status', 'standby')
        ->count();

    $shutdown = Machine::where('location_id', $locationId)
        ->where('status', 'shutdown')
        ->count();

    $faulty = Machine::where('location_id', $locationId)
        ->where('status', 'faulty')
        ->count();

    // Latest operators for this location
    $recentUsers = User::where('role', 'operator')
        ->where('location_id', $locationId)
        ->latest()
        ->take(5)
        ->get();

    // Latest meter logs for machines in this location
    $recentLogs = Meter::whereHas('machine', function ($query) use ($locationId) {
            $query->where('location_id', $locationId);
        })
        ->with('machine')
        ->latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'operators',
        'machines',
        'running',
        'standby',
        'shutdown',
        'faulty',
        'recentUsers',
        'recentLogs'
    ));
}

    public function meters()
    {
        $meters = Meter::with('machine')
                        ->latest()
                        ->get();

        return view('admin.meters.index', compact('meters'));
    }

    public function runningMachines()
{
    $runningMeters =
    Meter::whereNull('end_time')
    ->with('machine')
    ->get()
    ->map(function($m){

        return [

            'machine_id' => $m->machine_id,

            'machine_name' =>
            $m->machine->name ?? 'Unknown',

            'status' =>
            $m->machine->status,

            'start_time' =>
            $m->start_time->timestamp

        ];

    });

    return response()->json($runningMeters);
}
}