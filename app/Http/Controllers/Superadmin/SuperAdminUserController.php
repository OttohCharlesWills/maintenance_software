<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class SuperAdminUserController extends Controller
{

    public function index()
    {
        $users = User::with(['location','children.location'])
                    ->where('role','admin')
                    ->get();

        return view('superadmin.users.index', compact('users'));
    }



    public function create()
    {
        $locations = Location::all();

        return view('superadmin.users.create', compact('locations'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'location_id' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'location_id' => $request->location_id,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('superadmin.users.index')
            ->with('success','User created successfully');
    }

}