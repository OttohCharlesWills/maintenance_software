<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaultReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Location;

class MaintenanceReportController extends Controller
{

    public function adminIndex()
    {
        $reports = FaultReport::with(
            'machine',
            'operator'
        )->latest()->get();

        return view(
            'admin.maintenance.index',
            compact('reports')
        );
    }


    // public function superIndex()
    // {
    //     $reports = FaultReport::with(
    //         'machine',
    //         'operator'
    //     )->latest()->get();

    //     return view(
    //         'superadmin.maintenance.index',
    //         compact('reports')
    //     );
    // }


public function superIndex(Request $request)
{
    $date = $request->date ?? Carbon::today()->toDateString();

    $location_id = $request->location_id;

    $query = FaultReport::with([
        'machine',
        'operator'
    ]);

    // Filter by date
    $query->whereDate('created_at', $date);

    // Filter by shop/location
    if ($location_id) {
        $query->whereHas('machine', function ($q) use ($location_id) {
            $q->where('location_id', $location_id);
        });
    }

    $reports = $query->latest()->get();

    $locations = Location::all();

    return view(
        'superadmin.maintenance.index',
        compact('reports','locations','date','location_id')
    );
}

}