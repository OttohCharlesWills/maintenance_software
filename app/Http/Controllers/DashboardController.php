<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return redirect('/superadmin/dashboard');
        }

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user->role === 'operator') {
            return redirect('/operator/dashboard');
        }

        if ($user->role === 'viewer') {
            return redirect('/viewer/dashboard');
        }

        return redirect('/login');
    }
}