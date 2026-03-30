@extends('layouts.admin')

@section('admincontent')

<style>

.page-wrapper{
width: 70vw;
margin:auto;
padding-top:30px;
padding-left: 50px;
}

.machine-card{
border:none;
border-radius:10px;
box-shadow:0 6px 20px rgba(0,0,0,0.08);
}

.machine-table th{
font-weight:600;
color:#444;
padding:16px;
}

.machine-table td{
padding:18px 16px;
vertical-align:middle;
}

.status-badge{
padding:6px 14px;
font-size:13px;
border-radius:6px;
font-weight:500;
}

.status-running{
background:#28a745;
color:white;
}

.status-standby{
background:#f0ad4e;
color:white;
}

.status-shutdown{
background:#dc3545;
color:white;
}

.status-faulty{
background:#6c757d;
color:white;
}

.location-select{
width:220px;
}

table{
    border: 1px solid #6c757d;
    text-align: center
}

</style>


<div class="page-wrapper">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h3 class="fw-bold mb-0">Machines</h3>

        <form method="GET">

            <select name="location_id"
            class="form-select location-select"
            onchange="this.form.submit()">

                @foreach($locations as $location)

                <option value="{{ $location->id }}"
                {{ $locationId == $location->id ? 'selected' : '' }}>

                {{ $location->name }}

                @if($location->id == $myLocation)
                (My Location)
                @endif

                </option>

                @endforeach

            </select>

        </form>

    </div>
    <br>


    <!-- Machines Table -->
    <div class="card machine-card">

        <div class="card-body p-0">

            <table class="table machine-table mb-0">

                <thead class="table-light">
                    <tr>
                        <th>Machine</th>
                        <th>Status</th>
                        <th>Location</th>
                        {{-- <th class="text-end pe-4">Action</th> --}}
                    </tr>
                </thead>

                <tbody>

                    @foreach($machines as $machine)

                    <tr>

                        <td class="fw-semibold">
                            {{ $machine->name }}
                        </td>

                        <td>

                            @if($machine->status == 'running')
                                <span class="status-badge status-running">Running</span>

                            @elseif($machine->status == 'standby')
                                <span class="status-badge status-standby">Standby</span>

                            @elseif($machine->status == 'shutdown')
                                <span class="status-badge status-shutdown">Shutdown</span>

                            @elseif($machine->status == 'faulty')
                                <span class="status-badge status-faulty">Faulty</span>

                            @endif

                        </td>

                        <td>
                            {{ $machine->location->name }}
                        </td>

                        {{-- <td class="text-end pe-4">

                            @if($machine->location_id == $myLocation)

                                <button class="btn btn-sm btn-primary px-3">
                                    Control
                                </button>

                            @else

                                <span class="badge bg-secondary px-3 py-2">
                                    View Only
                                </span>

                            @endif

                        </td> --}}

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection