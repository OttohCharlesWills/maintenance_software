@extends('layouts.admin')

@section('admincontent')

<style>
    .dashboard-card {
        border-radius: 12px;
        padding: 20px;
        color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: .3s;
    }

    .dashboard-card:hover{
        transform: translateY(-3px);
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

    .dashboard-card h2{
        font-size:30px;
        font-weight:700;
        margin:0;
    }

    .dashboard-card p{
        margin:0;
        opacity:.9;
        font-size:15px;
    }

    .table-card{
        background:#fff;
        border-radius:12px;
        padding:20px;
        box-shadow:0 4px 10px rgba(0,0,0,.05);
    }

    .table th{
        font-weight:600;
    }
</style>

<div class="container-fluid">

    <br>

    {{-- DASHBOARD CARDS --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="dashboard-card card-green">
                <h2>{{ $operators }}</h2>
                <p>Operators</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="dashboard-card card-red">
                <h2>{{ $machines }}</h2>
                <p>Machines</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="dashboard-card status-green">
                <h2>{{ $running }}</h2>
                <p>Running</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="dashboard-card status-yellow">
                <h2>{{ $standby }}</h2>
                <p>Standby</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="dashboard-card status-danger">
                <h2>{{ $shutdown }}</h2>
                <p>Shutdown</p>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="dashboard-card status-gray">
                <h2>{{ $faulty }}</h2>
                <p>Faulty</p>
            </div>
        </div>

    </div>



    <div class="row">

        {{-- RECENT OPERATORS --}}
        <div class="col-lg-6 mb-4">

            <div class="table-card">

                <h5 class="mb-3">Recent Operators</h5>

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentUsers as $user)

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="2" class="text-center">
                                    No operators found.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>



        {{-- RECENT MACHINE LOGS --}}
        <div class="col-lg-6 mb-4">

            <div class="table-card">

                <h5 class="mb-3">Recent Machine Logs</h5>

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Machine</th>
                            <th>Status</th>
                            <th>Runtime</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentLogs as $log)

                            <tr>

                                <td>
                                    {{ $log->machine->name ?? '-' }}
                                </td>

                                <td>

                                    @if(optional($log->machine)->status == 'running')

                                        <span class="badge bg-success">
                                            Running
                                        </span>

                                    @elseif(optional($log->machine)->status == 'standby')

                                        <span class="badge bg-warning text-dark">
                                            Standby
                                        </span>

                                    @elseif(optional($log->machine)->status == 'shutdown')

                                        <span class="badge bg-danger">
                                            Shutdown
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Faulty
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @php

                                        $start = \Carbon\Carbon::parse($log->updated_at);

                                        $end = \Carbon\Carbon::parse($log->created_at);

                                        $seconds = $end->diffInSeconds($start);

                                        $hours = floor($seconds / 3600);

                                        $minutes = floor(($seconds % 3600) / 60);

                                        $secs = $seconds % 60;

                                    @endphp

                                    {{ sprintf('%02d:%02d:%02d',$hours,$minutes,$secs) }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3" class="text-center">
                                    No machine logs found.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection