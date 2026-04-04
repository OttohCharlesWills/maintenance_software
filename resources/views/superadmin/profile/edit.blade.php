@extends('layouts.superadmin')

@section('supercontent')

<div class="container" style="padding:20px; max-width:600px;">

    <h3>Account Settings</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('superadmin.profile.update') }}">

        @csrf

            <div class="mb-3">
                <label>Email</label>

                <input type="email"
                    name="email"
                    value="{{ $user->email }}"
                    class="form-control"
                    required>
                </div>


            <div class="mb-3">
                <label>New Password</label>

                <input type="password"
                    name="password"
                    class="form-control">
            </div>


            <div class="mb-3">
                <label>Confirm Password</label>

                <input type="password"
                        name="password_confirmation"
                        class="form-control">
            </div>


            <button class="btn btn-primary">
                Update Account
            </button>

    </form>

</div>

@endsection