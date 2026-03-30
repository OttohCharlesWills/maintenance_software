@extends('layouts.superadmin')

@section('supercontent')

<div class="container" style="padding: 1rem 1rem">

    <h3>Create User</h3>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('superadmin.users.store') }}">

                @csrf

                <div class="row">

                    {{-- NAME --}}
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required>
                    </div>


                    {{-- EMAIL --}}
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               required>
                    </div>


                    {{-- PASSWORD --}}
                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>


                    {{-- ROLE --}}
                    <div class="col-md-6 mb-3">
                        <label>Role</label>

                        <select name="role" class="form-control" required>

                            <option value="">Select Role</option>

                            <option value="superadmin">Super Admin</option>

                            <option value="admin">Admin</option>

                            <option value="operator">Operator</option>

                            <option value="viewer">Viewer</option>

                        </select>
                    </div>


                    {{-- LOCATION --}}
                    <div class="col-md-6 mb-3">
                        <label>Location</label>

                        <select name="location_id" class="form-control" required>

                            <option value="">Select Location</option>

                            @foreach($locations as $location)

                                <option value="{{ $location->id }}">
                                    {{ $location->name }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                </div>


                <button class="btn btn-primary">
                    Create User
                </button>

            </form>

        </div>
    </div>

</div>

@endsection