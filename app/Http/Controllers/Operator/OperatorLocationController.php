<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Location;

class OperatorLocationController extends Controller
{

    public function index()
    {
        $locations = Location::latest()->get();

        $myLocation = auth()->user()->location_id;

        return view('operator.locations.index', compact(
            'locations',
            'myLocation'
        ));
    }

}