@extends('layouts.operator')

@section('operatorcontent')

<div class="container-fluid">

    <div class="mb-4">
        <h4 class="fw-bold">Machines</h4>
        <p class="text-muted">
            Control machine status and runtime
        </p>
    </div>


    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Machine</th>
                        <th>Status</th>
                        <th width="220">Change Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($machines as $machine)

                    <tr>

                        <td class="ps-3 fw-semibold">
                            {{ $machine->name }}
                        </td>


                        <td>

                            @if($machine->status == 'running')
                                <span class="badge bg-success">
                                    Running
                                </span>

                            @elseif($machine->status == 'standby')
                                <span class="badge bg-warning">
                                    Standby
                                </span>

                            @elseif($machine->status == 'shutdown')
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

                            <form method="POST"
                                  action="{{ route('operator.machine.status') }}">

                                @csrf

                                <input type="hidden"
                                    name="machine_id"
                                    value="{{ $machine->id }}">

                                <select name="status"
                                        class="form-select"
                                        onchange="this.form.submit()">

                                    <option value="standby"
                                    {{ $machine->status=='standby'?'selected':'' }}>
                                    Standby
                                    </option>

                                    <option value="running"
                                    {{ $machine->status=='running'?'selected':'' }}>
                                    Running
                                    </option>

                                    <option value="shutdown"
                                    {{ $machine->status=='shutdown'?'selected':'' }}>
                                    Shutdown
                                    </option>

                                    <option value="faulty"
                                    {{ $machine->status=='faulty'?'selected':'' }}>
                                    Faulty
                                    </option>

                                </select>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection