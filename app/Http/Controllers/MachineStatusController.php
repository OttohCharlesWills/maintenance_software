<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Meter;
use Auth;

class MachineStatusController extends Controller
{

    public function update(Request $request,$id)
    {

        $machine = Machine::findOrFail($id);

        $status = $request->status;

        if($status == "running"){

            Meter::create([

                'machine_id'=>$machine->id,

                'started_by'=>Auth::id(),

                'start_time'=>now()

            ]);

        }

        if($status == "shutdown" || $status == "faulty"){

            $meter = Meter::where('machine_id',$machine->id)
            ->whereNull('end_time')
            ->first();

            if($meter){

                $meter->update([

                    'ended_by'=>Auth::id(),

                    'end_time'=>now(),

                    'duration_seconds'=>now()->diffInSeconds($meter->start_time)

                ]);

            }

        }

        $machine->update([

            'status'=>$status

        ]);

        return response()->json(['success'=>true]);

    }

}