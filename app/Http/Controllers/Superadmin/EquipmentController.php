<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Meter;
use Illuminate\Support\Facades\Http;
// use Cloudinary\Cloudinary;

class EquipmentController extends Controller
{
    public function index()
    {
        $machines = Machine::latest()->get();
        $locations = Location::all();

        return view('superadmin.equipment.index', compact('machines','locations'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'machine_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'location_id' => 'required|exists:locations,id'
    ]);

    $imagePath = null;

    if ($request->hasFile('machine_image')) {

        $file = $request->file('machine_image');

        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads/machines'), $filename);

        $imagePath = 'uploads/machines/'.$filename;
    }

    Machine::create([
        'name' => $request->name,
        'serial_number' => $request->serial_number,
        'image' => $imagePath,
        'status' => 'inactive',
        'created_by' => auth()->id(),
        'location_id' => $request->location_id
    ]);

    return back()->with('success', 'Machine added successfully.');
}

public function updateStatus(Request $request, $id)
{
    $machine = Machine::findOrFail($id);

    $request->validate([
        'status' => 'required|in:running,standby,shutdown,faulty'
    ]);

    $status = $request->status;

    if ($status === 'running') {
        // Start a new meter log only if no running log exists
        $existing = Meter::where('machine_id', $machine->id)
                         ->whereNull('end_time')
                         ->first();

        if (!$existing) {
            Meter::create([
                'machine_id' => $machine->id,
                'started_by' => auth()->id(),
                'start_time' => now()
            ]);
        }
    }

    if ($status === 'shutdown') {
        // End the last running meter log
        $meter = Meter::where('machine_id', $machine->id)
                      ->whereNull('end_time')
                      ->latest('start_time')
                      ->first();

        if ($meter) {
            $meter->end_time = now();
            $meter->duration_seconds = now()->diffInSeconds($meter->start_time);
            $meter->ended_by = auth()->id();
            $meter->save();
        }
    }

    $machine->status = $status;
    $machine->save();

    return redirect()->route('superadmin.equipment')
                     ->with('success', 'Machine status updated successfully.');
}


public function meterPage()
{

    $meters = Meter::with('machine')
                    ->latest()
                    ->get();

    return view('superadmin.meters.index', compact('meters'));

}

public function runningMachines()
{
    $runningMeters = Meter::whereNull('end_time')
        ->with('machine')
        ->get()
        ->map(function($m){
            return [
                'machine_id' => $m->machine_id,
                'machine_name' => $m->machine->name ?? 'Unknown',
                'status' => $m->machine->status,
                'start_time' => $m->start_time->timestamp
            ];
        });

    return response()->json($runningMeters);
}
}