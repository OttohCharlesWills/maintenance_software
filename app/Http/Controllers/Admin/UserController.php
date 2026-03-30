<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('created_by', auth()->id())
                    ->latest()
                    ->get();

        return view('admin.users.index', compact('users'));
    }



    public function create()
    {
        return view('admin.users.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'role' => $request->role,

            'location_id' => auth()->user()->location_id,

            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success','User created successfully');
    }

}