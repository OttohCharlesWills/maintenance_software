<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login based on role
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return '/superadmin/dashboard';
        }

        if ($user->role === 'admin') {
            return '/admin/dashboard';
        }

        if ($user->role === 'operator') {
            return '/operator/dashboard';
        }

        if ($user->role === 'viewer') {
            return '/viewer/dashboard';
        }

        return '/login';
    }

    /**
     * Controller constructor
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}