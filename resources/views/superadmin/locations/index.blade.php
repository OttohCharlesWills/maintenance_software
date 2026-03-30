@extends('layouts.superadmin')

@section('supercontent')
<div class="container" style="padding: 1rem 1rem">
    <h1>Manage Locations</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <!-- Left: Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ isset($locationToEdit) ? 'Edit Location' : 'Add Location' }}</div>
                <div class="card-body">
                    <form action="{{ isset($locationToEdit) ? route('superadmin.locations.update', $locationToEdit->id) : route('superadmin.locations.store') }}" method="POST">
                        @csrf
                        @if(isset($locationToEdit))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Location Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $locationToEdit->name ?? old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">{{ isset($locationToEdit) ? 'Update' : 'Add' }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right: Table -->
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $location->name }}</td>
                            <td>
                                <a href="{{ route('superadmin.locations.index', ['edit' => $location->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('superadmin.locations.destroy', $location->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this location?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection