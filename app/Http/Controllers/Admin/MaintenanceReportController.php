<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaultReport;

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


    public function superIndex()
    {
        $reports = FaultReport::with(
            'machine',
            'operator'
        )->latest()->get();

        return view(
            'superadmin.maintenance.index',
            compact('reports')
        );
    }

}