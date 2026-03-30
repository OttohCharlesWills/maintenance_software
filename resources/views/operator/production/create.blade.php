@extends('layouts.operator')

@section('operatorcontent')

    <div class="container">

        <h3 class="mb-4">Production Report</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        <form method="POST" action="{{ route('production.store') }}">

            @csrf

                <div class="mb-3">
                    <label class="form-label">Select Machine</label>

                    <select name="machine_id" class="form-control" required>

                        <option value="">Choose Machine</option>

                            @foreach($machines as $machine)

                            <option value="{{ $machine->id }}">
                                {{ $machine->name }}
                            </option>

                            @endforeach

                    </select>

                </div>

            <div class="mb-3">

                <label>Basic Sediment & Water (BS&W)</label>

                <input type="number" step="0.01" name="bsw" class="form-control">

            </div>

            <div class="mb-3">

                <label>Gross</label>

                <input type="number" step="0.01" name="gross" class="form-control" required>

            </div>

            <div class="mb-3">

                <label>Net</label>

                <input type="number" step="0.01" name="net" class="form-control" required>

            </div>

            <div class="mb-3">

                <label>Net Previous Day</label>

                <input type="number" step="0.01" name="net_previous_day" class="form-control">

            </div>

            <div class="mb-3">

                <label>Month To Date</label>

                <input type="number" step="0.01" name="month_to_date" class="form-control">

            </div>

            <button class="btn btn-primary">
                Submit Production Report
            </button>

        </form>

    </div>

@endsection