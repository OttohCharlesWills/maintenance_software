<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    // Show all locations
    public function index(Request $request)
    {
        $locations = Location::latest()->get();
        $locationToEdit = null;

        if ($request->has('edit')) {
            $locationToEdit = Location::find($request->edit);
        }

        return view('superadmin.locations.index', compact('locations', 'locationToEdit'));
    }

    // Show create form
    public function create()
    {
        return view('superadmin.locations.create');
    }

    // Store new location
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
        ]);

        Location::create($request->only('name'));

        return redirect()->route('superadmin.locations.index')->with('success', 'Location added!');
    }

    // Show edit form
    public function edit(Location $location)
    {
        return view('superadmin.locations.edit', compact('location'));
    }

    // Update location
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id,
        ]);

        $location->update($request->only('name'));

        return redirect()->route('superadmin.locations.index')->with('success', 'Location updated!');
    }

    // Delete location
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('superadmin.locations.index')->with('success', 'Location deleted!');
    }
}