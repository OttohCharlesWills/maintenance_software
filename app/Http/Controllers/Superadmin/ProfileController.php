<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::user();

        return view('superadmin.profile.edit', compact('user'));
    }


    public function update(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:6|confirmed'
        ]);

        $user = Auth::user();

        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success','Profile Updated Successfully');
    }

}