<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\productionReport;

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


    public function superIndex()
    {
        $reports = ProductionReport::with([
            'machine',
            'operator'
        ])->latest()->get();

        return view(
            'superadmin.production.index',
            compact('reports')
        );
    }

}