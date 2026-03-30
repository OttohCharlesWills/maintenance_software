@extends('layouts.operator')

@section('operatorcontent')

<div class="card">
    <div class="card-header">
        Report for {{ $machine->name }}
    </div>

    <div class="card-body">

        <form method="POST"
        action="{{ route('operator.report.store') }}">

            @csrf

            <input type="hidden"
            name="machine_id"
            value="{{ $machine->id }}">


            <div class="mb-3">
                <label>Fault Reason</label>
                <textarea name="fault_reason"
                class="form-control"></textarea>
            </div>


            <div class="mb-3">
                <label>Fix / Remedy</label>
                <textarea name="remedy"
                class="form-control"></textarea>
            </div>


            <div class="mb-3">
                <label>Estimated Time</label>
                <input type="text"
                name="estimated_time"
                class="form-control"
                placeholder="2 hours / 1 day">
            </div>


            <button class="btn btn-primary">
                Submit Report
            </button>

        </form>

    </div>
</div>

@endsection