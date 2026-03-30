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