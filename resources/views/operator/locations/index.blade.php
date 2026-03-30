@extends('layouts.operator')

@section('operatorcontent')

<style>
    .location-card{
border-radius:12px;
overflow:hidden;
}

.table th{
padding-top:18px;
padding-bottom:18px;
font-weight:600;
}

.table td{
padding-top:20px;
padding-bottom:20px;
font-size:15px;
}

.table thead{
background:#f8f9fa;
}

.table tbody tr:hover{
background:#f4f6f9;
}

.container{
    width: 70vw;
}
</style>

<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">

        <div>
            <h2 class="fw-bold mb-1">Locations</h2>
            <p class="text-muted mb-0">Manage and view available store locations</p>
        </div>

        <span class="badge bg-primary px-4 py-2 fs-6">
            {{ $locations->count() }} Locations
        </span>

    </div>


    <!-- Centered Card -->
    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0 location-card">

                <div class="card-body p-0">

                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th class="ps-4">Name</th>
                                <th class="text-end pe-4">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($locations as $location)

                            <tr>

                                <td class="ps-4 fw-semibold">
                                    {{ $location->name }}
                                </td>

                                <td class="text-end pe-4">

                                    @if($location->id == auth()->user()->location_id)

                                        <span class="badge bg-success px-3 py-2">
                                            My Location
                                        </span>

                                    @else

                                        <span class="badge bg-secondary px-3 py-2">
                                            View Only
                                        </span>

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection