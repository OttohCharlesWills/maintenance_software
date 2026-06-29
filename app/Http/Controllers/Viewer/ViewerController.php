<?php

namespace App\Http\Controllers\Viewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewerController extends Controller
{
    public function dashboard()
    {
        return view('viewers.dashboard'); // resources/views/admin/dashboard.blade.php
    }
}