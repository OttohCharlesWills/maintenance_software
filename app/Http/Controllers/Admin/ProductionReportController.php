<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\productionReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Location;

class ProductionReportController extends Controller
{

    public function adminIndex()
    {
        $reports = ProductionReport::with([
            'machine',
            'operator'
        ])->latest()->get();

        return view(
            'admin.production.index',
            compact('reports')
        );
    }


    // public function superIndex()
    // {
    //     $reports = ProductionReport::with([
    //         'machine',
    //         'operator'
    //     ])->latest()->get();

    //     return view(
    //         'superadmin.production.index',
    //         compact('reports')
    //     );
    // }

    public function superIndex(Request $request)
    {
        $date = $request->date ?? Carbon::today()->toDateString();

        $location_id = $request->location_id;

        $query = ProductionReport::with([
            'machine',
            'operator'
        ]);

        // filter by date
        $query->whereDate('report_date', $date);

        // filter by shop/location
        if ($location_id) {
            $query->whereHas('machine', function ($q) use ($location_id) {
                $q->where('location_id', $location_id);
            });
        }

        $reports = $query->latest()->get();

        $locations = Location::all();

        return view(
            'superadmin.production.index',
            compact('reports','locations','date','location_id')
        );
    }

}