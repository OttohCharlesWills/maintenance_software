<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;

class AdminLocationController extends Controller
{

    public function index()
    {
        $locations = Location::latest()->get();

        $myLocation = auth()->user()->location_id;

        return view('admin.locations.index', compact(
            'locations',
            'myLocation'
        ));
    }

}