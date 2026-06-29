<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Meter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
 public function dashboard()
{
    $operator = Auth::user();

    $locationId = $operator->location_id;

    // Machine Counts
    $machines = Machine::where('location_id', $locationId)->count();

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

    // Sessions started by this operator
    $myReadings = Meter::where('started_by', $operator->id)->count();

    // Sessions started today
    $todayReadings = Meter::where('started_by', $operator->id)
        ->whereDate('created_at', today())
        ->count();

    // Recent sessions
    $recentLogs = Meter::where('started_by', $operator->id)
        ->with('machine')
        ->latest()
        ->take(5)
        ->get();

    return view('operator.dashboard', compact(
        'machines',
        'running',
        'standby',
        'shutdown',
        'faulty',
        'myReadings',
        'todayReadings',
        'recentLogs'
    ));
}

    public function machines()
    {

        $machines = Machine::where(
            'location_id',
            auth()->user()->location_id
        )->get();


        return view(
            'operator.machines.index',
            compact('machines')
        );

    }



    public function updateStatus(Request $request)
    {

        $machine = Machine::findOrFail(
            $request->machine_id
        );


        $machine->status = $request->status;
        $machine->save();



        // START TIMER
        if($request->status == 'running'){

            Meter::create([
                'machine_id' => $machine->id,
                'started_by' => auth()->id(),
                'start_time' => now()
            ]);

        }


        // STOP TIMER
        if(
            $request->status == 'shutdown'
            || $request->status == 'faulty'
        ){

            Meter::where('machine_id',$machine->id)
            ->whereNull('end_time')
            ->latest()
            ->first()
            ?->update([
                'end_time' => now()
            ]);

        }


        return back();

    }

    

    
    public function meters()
    {
        $meters = Meter::with('machine')
                        ->latest()
                        ->get();

        return view('operator.meters.index', compact('meters'));
    }

    public function runMachines()
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