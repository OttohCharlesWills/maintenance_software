<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\Location;
use Illuminate\Http\Request;

class MachineController extends Controller
{

    public function index(Request $request)
    {
        $locations = Location::all();

        $locationId = $request->location_id 
                        ?? auth()->user()->location_id;

        $machines = Machine::where('location_id', $locationId)
                    ->latest()
                    ->get();

        $myLocation = auth()->user()->location_id;

        return view('admin.machines.index', compact(
            'machines',
            'locations',
            'locationId',
            'myLocation'
        ));
    }

}