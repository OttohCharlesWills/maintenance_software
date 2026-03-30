@extends('layouts.admin')

@section('admincontent')

<div class="container" style="padding: 1rem 1rem">

    <h4>Create User</h4>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.users.store') }}">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" required>

                        <option value="">Select Role</option>

                        <option value="operator">Operator</option>

                        <option value="viewer">Viewer</option>

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