@extends('layouts.superadmin')

@section('supercontent')

<style>
    .dashboard-card {
        border-radius: 12px;
        padding: 20px;
        color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .card-blue { 
        background: linear-gradient(135deg,#040250d0,#040250d0); 
    }

    .card-green { 
        background: linear-gradient(135deg,#033025,#033025); 
    }

    .card-orange { 
        background: linear-gradient(135deg,#4d2a05,#4d2a05); 
    }

    .card-red { 
        background: linear-gradient(135deg,#570e08,#570e08); 
    }

    .status-green { 
        background: linear-gradient(135deg,#0a3634,#0a3634); 
    }

    .status-yellow { 
        background: linear-gradient(135deg,#553f09,#553f09); 
    }

    .status-danger { 
        background: linear-gradient(135deg,#460909,#330b0b); 
    }

    .status-gray { 
        background: linear-gradient(135deg,#3c3e41,#3c3e41); 
    }

    .dashboard-card h2 {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-card p {
        margin: 0;
        opacity: .9;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
</style>

<div class="container-fluid">
<br>

    {{-- TOP STATS --}}
    <div class="row mb-4">

        <div class="col-md-3">
            <div class="dashboard-card card-blue">
                <h2>{{ $admins }}</h2>
                <p>Admins</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card card-green">
                <h2>{{ $operators }}</h2>
                <p>Operators</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card card-orange">
                <h2>{{ $locations }}</h2>
                <p>Locations</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card card-red">
                <h2>{{ $machines }}</h2>
                <p>Machines</p>
            </div>
        </div>
    </div>



    {{-- MACHINE STATUS --}}
    <div class="row mb-4">

       <div class="col-md-3">
            <div class="dashboard-card status-green">
                <h2>{{ $running }}</h2>
                <p>Running</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card status-yellow">
                <h2>{{ $standby }}</h2>
                <p>Standby</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card status-danger">
                <h2>{{ $shutdown }}</h2>
                <p>Shutdown</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card status-gray">
                <h2>{{ $faulty }}</h2>
                <p>Faulty</p>
            </div>
        </div>

    </div>



    <div class="row">

        {{-- RECENT USERS --}}
        <div class="col-md-6">

            <div class="table-card">

                <h5 class="mb-3">Recent Users</h5>

                <table class="table">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Location</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($recentUsers as $user)

                        <tr>
                            <td>{{ $user->name }}</td>

                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-primary">Admin</span>
                                @elseif($user->role == 'operator')
                                    <span class="badge bg-success">Operator</span>
                                @elseif($user->role == 'viewer')
                                    <span class="badge bg-secondary">Viewer</span>
                                @else
                                    <span class="badge bg-dark">Super Admin</span>
                                @endif
                            </td>

                            <td>{{ $user->location->name ?? '-' }}</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>



        {{-- MACHINE LOGS --}}
        <div class="col-md-6">

            <div class="table-card">

                <h5 class="mb-3">Recent Machine Logs</h5>

                <table class="table">

                    <thead>
                        <tr>
                            <th>Machine</th>
                            <th>Status</th>
                            <th>Runtime</th>
                            <th>Location</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($recentLogs as $log)

                            <tr>

                                <td>{{ $log->machine->name ?? '-' }}</td>

                                <td>
                                    @if($log->machine->status == 'running')
                                        <span class="badge bg-success">Running</span>

                                    @elseif($log->machine->status == 'standby')
                                        <span class="badge bg-warning">Standby</span>

                                    @elseif($log->machine->status == 'shutdown')
                                        <span class="badge bg-danger">Shutdown</span>

                                    @else
                                        <span class="badge bg-secondary">Faulty</span>
                                    @endif
                                </td>

                                <td>
                                    @php
                                        $start = \Carbon\Carbon::parse($log->updated_at);
                                        $end = \Carbon\Carbon::parse($log->created_at);

                                        $diff = $end->diffInSeconds($start);

                                        $h = str_pad(floor($diff / 3600), 2, '0', STR_PAD_LEFT);
                                        $m = str_pad(floor(($diff % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                        $s = str_pad($diff % 60, 2, '0', STR_PAD_LEFT);
                                    @endphp

                                    {{ $h }}:{{ $m }}:{{ $s }}
                                </td>

                                <td>{{ $log->machine->location->name ?? '-' }}</td>

                            </tr>

                            @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection