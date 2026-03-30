<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\ProductionReport;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{
    
    public function create()
    {
        $machines = Machine::all();

        return view('operator.production.create', compact('machines'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'machine_id' => 'required',
            'bsw' => 'nullable|numeric',
            'gross' => 'required|numeric',
            'net' => 'required|numeric',
            'net_previous_day' => 'nullable|numeric',
            'month_to_date' => 'nullable|numeric',
        ]);

        ProductionReport::create([
            'machine_id' => $request->machine_id,
            'operator_id' => Auth::id(),
            'bsw' => $request->bsw,
            'gross' => $request->gross,
            'net' => $request->net,
            'net_previous_day' => $request->net_previous_day,
            'month_to_date' => $request->month_to_date,
            'report_date' => now(),
        ]);

        return redirect()->back()->with('success','Production Report Submitted Successfully');
    }

}