@extends('layouts.operator')

@section('operatorcontent')

<div class="card">
    <div class="card-header">
        Faulty Machines
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th>Machine</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

                @foreach($machines as $machine)

                <tr>
                    <td>{{ $machine->name }}</td>
                    <td>
                        <span class="badge bg-danger">
                            Faulty
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('operator.report.create',$machine->id) }}"
                           class="btn btn-sm btn-dark">

                           File Report
                        </a>
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>
</div>

@endsection