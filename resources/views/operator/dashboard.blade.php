@extends('layouts.operator')

@section('operatorcontent')

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

    .card-blue{
        background:linear-gradient(135deg,#040250d0,#040250d0);
    }

    .card-green{
        background:linear-gradient(135deg,#033025,#033025);
    }

    .card-orange{
        background:linear-gradient(135deg,#4d2a05,#4d2a05);
    }

    .card-red{
        background:linear-gradient(135deg,#570e08,#570e08);
    }

    .status-green{
        background:linear-gradient(135deg,#0a3634,#0a3634);
    }

    .status-yellow{
        background:linear-gradient(135deg,#553f09,#553f09);
    }

    .status-danger{
        background:linear-gradient(135deg,#460909,#330b0b);
    }

    .dashboard-card h2{
        font-size:30px;
        font-weight:bold;
        margin:0;
    }

    .dashboard-card p{
        margin:0;
        opacity:.9;
    }

    .table-card{
        background:#fff;
        border-radius:12px;
        padding:20px;
        box-shadow:0 4px 10px rgba(0,0,0,.05);
    }
</style>

<div class="container-fluid">

    <br>

    {{-- TOP CARDS --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card card-red">
                <h2>{{ $machines }}</h2>
                <p>Machines</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card status-green">
                <h2>{{ $running }}</h2>
                <p>Running</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card status-yellow">
                <h2>{{ $standby }}</h2>
                <p>Standby</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card status-danger">
                <h2>{{ $shutdown }}</h2>
                <p>Shutdown</p>
            </div>
        </div>

    </div>

    <div class="row g-3 mb-4">

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card card-blue">
                <h2>{{ $faulty }}</h2>
                <p>Faulty Machines</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="dashboard-card card-green">
                <h2>{{ $myReadings }}</h2>
                <p>My Readings</p>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="dashboard-card card-orange">
                <h2>{{ $todayReadings }}</h2>
                <p>Today's Readings</p>
            </div>
        </div>

    </div>

    {{-- RECENT READINGS --}}
    <div class="row">

        <div class="col-lg-12">

            <div class="table-card">

                <h5 class="mb-3">My Recent Meter Readings</h5>

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>Machine</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentLogs as $log)

                            <tr>

                                <td>{{ $log->machine->name ?? '-' }}</td>

                                <td>

                                    @if(optional($log->machine)->status == 'running')

                                        <span class="badge bg-success">Running</span>

                                    @elseif(optional($log->machine)->status == 'standby')

                                        <span class="badge bg-warning text-dark">Standby</span>

                                    @elseif(optional($log->machine)->status == 'shutdown')

                                        <span class="badge bg-danger">Shutdown</span>

                                    @else

                                        <span class="badge bg-secondary">Faulty</span>

                                    @endif

                                </td>

                                <td>{{ $log->created_at->format('d M Y h:i A') }}</td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3" class="text-center">
                                    No meter readings found.
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