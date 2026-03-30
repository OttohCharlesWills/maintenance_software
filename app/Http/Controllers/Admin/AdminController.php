<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Meter;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
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