@extends('layouts.admin')

@section('admincontent')

<div class="card" style="margin-left: 20px; margin-top: 20px; width:70vw;">
    <div class="card-header">Maintenance Reports</div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Machine</th>
                    <th>Operator</th>
                    <th>Fault</th>
                    <th>Remedy</th>
                    <th>Estimated Time</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                @foreach($reports as $report)

                    <tr>

                        <td>{{ $report->machine->name }}</td>

                        <td>{{ $report->operator->name }}</td>

                        <td>{{ $report->fault_reason }}</td>

                        <td>{{ $report->remedy }}</td>

                        <td>
                            <span class="badge bg-warning">
                                {{ $report->estimated_time }}
                            </span>
                        </td>

                        <td>
                            {{ $report->created_at->format('d M Y H:i') }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>
</div>

@endsection