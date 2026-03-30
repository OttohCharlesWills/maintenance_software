<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\FaultReport;

class OperatorReportController extends Controller
{

    // list faulty machines
    public function index()
    {
        $machines = Machine::where(
                'location_id',
                auth()->user()->location_id
            )
            ->where('status','faulty')
            ->get();

        return view(
            'operator.reports.index',
            compact('machines')
        );
    }



    // open report page
    public function create(Machine $machine)
    {
        return view(
            'operator.reports.create',
            compact('machine')
        );
    }



    // store report
    public function store(Request $request)
    {
        FaultReport::create([

            'machine_id' => $request->machine_id,
            'operator_id' => auth()->id(),

            'fault_reason' => $request->fault_reason,
            'remedy' => $request->remedy,
            'estimated_time' => $request->estimated_time,

        ]);

        return redirect()
        ->route('operator.reports')
        ->with('success','Report submitted');

    }

}