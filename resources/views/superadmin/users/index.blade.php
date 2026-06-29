@extends('layouts.superadmin')

@section('supercontent')

<style>
.parent-row{
    cursor:pointer;
    background:#fafafa;
}

.parent-row:hover{
    background:#f1f1f1;
}
</style>

<div class="container" style="padding: 1rem 1rem">

    <h3>Users</h3>

    <a href="{{ route('superadmin.users.create') }}"
       class="btn btn-primary mb-3">
        Create User
    </a>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($users as $user)

                        {{-- PARENT USER --}}
                        <tr class="parent-row"
                            data-id="{{ $user->id }}">

                            <td>
                                <span class="toggle"
                                      data-id="{{ $user->id }}"
                                      style="cursor:pointer;">
                                      ▶
                                </span>

                                {{ $user->name }}
                            </td>

                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->location->name ?? '-' }}</td>
                            <td>

                                {{-- <form action="{{ route('superadmin.users.updateRole',$user) }}"
                                    method="POST"
                                    class="mb-2">

                                    @csrf
                                    @method('PUT')

                                    <select name="role"
                                            class="form-select form-select-sm"
                                            onchange="this.form.submit()">

                                        <option value="admin"
                                            {{ $user->role=='admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>

                                        <option value="operator"
                                            {{ $user->role=='operator' ? 'selected' : '' }}>
                                            Operator
                                        </option>

                                    </select>

                                </form> --}}

                                <form action="{{ route('superadmin.users.destroy',$user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this user?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm w-100">
                                        Delete
                                    </button>

                                </form>

                            </td>
                        </tr>


                        {{-- CHILD USERS --}}
                        @foreach($user->children as $child)

                        <tr class="child-row child-of-{{ $user->id }}"
                            style="display:none;">

                            <td style="padding-left:40px;">
                                └── {{ $child->name }}
                            </td>

                            <td>{{ $child->email }}</td>
                            <td>{{ ucfirst($child->role) }}</td>
                            <td>{{ $child->location->name ?? '-' }}</td>
                            <td>

                                {{-- <form action="{{ route('superadmin.users.updateRole',$user) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PUT')

                                    <select name="role"
                                            class="form-select form-select-sm"
                                            onchange="this.form.submit()">

                                        <option value="admin"
                                            {{ $user->role=='admin'?'selected':'' }}>
                                            Admin
                                        </option>

                                        <option value="operator"
                                            {{ $user->role=='operator'?'selected':'' }}>
                                            Operator
                                        </option>

                                    </select>

                                </form> --}}

                                <form action="{{ route('superadmin.users.destroy',$user) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Delete this user?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger mt-2">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    @endforeach

                </tbody>

            </table>

        </div>
    </div>

</div>


<script>
document.querySelectorAll('.parent-row').forEach(row => {

    row.addEventListener('click', function(e){

        let id = this.dataset.id;
        let rows = document.querySelectorAll('.child-of-' + id);
        let toggle = this.querySelector('.toggle');

        let isHidden = rows[0]?.style.display === 'none' || rows[0]?.style.display === '';

        rows.forEach(child => {
            child.style.display = isHidden ? 'table-row' : 'none';
        });

        // rotate arrow
        if(toggle){
            toggle.innerText = isHidden ? '▼' : '▶';
        }

    });

});
</script>

@endsection