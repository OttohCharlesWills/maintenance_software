@extends('layouts.superadmin')

@section('supercontent')

<div class="container" style="padding: 1rem 1rem">

    {{-- =========================================
        PAGE TITLE
    ========================================== --}}
    <h2>Equipment</h2>



    {{-- =========================================
        ERROR SECTION
    ========================================== --}}
 @if(session('success'))
    <div class="text-success">
        {{ session('success') }}
    </div>
@endif



    {{-- =========================================
        CREATE MACHINE FORM
    ========================================== --}}
    <div class="card mb-4">

        <div class="card-header">
            Create Equipment
        </div>

        <div class="card-body">

            <form 
                method="POST"
                action="/superadmin/equipment/store"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- MACHINE NAME --}}
                <div class="mb-3">

                    <label>Machine Name</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Machine name"
                        required
                    >

                </div>



                {{-- LOCATION --}}
                <div class="mb-3">

                    <label>Location</label>

                    <select 
                        name="location_id"
                        class="form-control"
                        required
                    >

                        <option value="">Select Location</option>

                        @foreach($locations as $location)

                            <option value="{{ $location->id }}">
                                {{ $location->name }}
                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- MACHINE IMAGE --}}
                <div class="mb-3">

                    <label>Machine Image</label>

                    <input
                        type="file"
                        name="machine_image"
                        class="form-control"
                        required
                    >

                </div>



                {{-- SUBMIT BUTTON --}}
                <button 
                    type="submit"
                    class="btn btn-primary"
                >

                    Create Machine

                </button>

            </form>

        </div>

    </div>



    {{-- =========================================
        MACHINE TABLE
    ========================================== --}}
    <div class="card">

        <div class="card-header">
            Existing Equipment
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                {{-- ================= TABLE HEAD ================= --}}
                <thead>

                    <tr>

                        <th>Image</th>

                        <th>Name</th>

                        <th>Location</th>

                        <th>Status</th>

                        <th width="250">Action</th>

                    </tr>

                </thead>



                {{-- ================= TABLE BODY ================= --}}
                <tbody>

                    @foreach($machines as $machine)

                        <tr>

                            {{-- MACHINE IMAGE --}}
                            <td>

                                <img
                                    src="{{ asset($machine->image) }}"
                                    width="80"
                                >

                            </td>



                            {{-- MACHINE NAME --}}
                            <td>

                                {{ $machine->name }}

                            </td>



                            {{-- MACHINE LOCATION --}}
                            <td>

                                {{ $machine->location->name ?? 'N/A' }}

                            </td>



                            {{-- MACHINE STATUS --}}
                            <td>

                                <span

                                    class="badge

                                    @if($machine->status == 'running') bg-success
                                    @elseif($machine->status == 'standby') bg-warning
                                    @elseif($machine->status == 'shutdown') bg-dark
                                    @elseif($machine->status == 'faulty') bg-danger
                                    @else bg-secondary
                                    @endif

                                    "

                                >

                                    {{ $machine->status }}

                                </span>

                            </td>



                            {{-- MACHINE ACTION --}}
                            <td>

                                <form
                                    method="POST"
                                    action="/machine/status/{{ $machine->id }}"
                                >

                                    @csrf


                                    <select
                                        name="status"
                                        class="form-select"
                                        onchange="this.form.submit()"
                                    >

                                        <option value="">
                                            Select Action
                                        </option>



                                        <option 
                                            value="running"
                                            {{ $machine->status == 'running' ? 'selected' : '' }}
                                        >
                                            Run
                                        </option>



                                        <option 
                                            value="standby"
                                            {{ $machine->status == 'standby' ? 'selected' : '' }}
                                        >
                                            Standby
                                        </option>



                                        <option 
                                            value="shutdown"
                                            {{ $machine->status == 'shutdown' ? 'selected' : '' }}
                                        >
                                            Shutdown
                                        </option>



                                        <option 
                                            value="faulty"
                                            {{ $machine->status == 'faulty' ? 'selected' : '' }}
                                        >
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