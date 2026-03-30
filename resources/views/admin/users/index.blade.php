@extends('layouts.admin')

@section('admincontent')

<style>
    .container{
        width: 70vw;
    }
</style>

<div class="container" style="padding: 1rem 1rem">

    <h4>My Users</h4>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create User</a>

    <div class="card">
        <div class="card-body">

            <table class="table">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Location</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ auth()->user()->location->name ?? '-' }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection