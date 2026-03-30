@extends('layouts.operator')

@section('operatorcontent')

<div class="container-fluid">

    <div class="mb-4">
        <h4 class="fw-bold">Machine Meter Records</h4>
        <p class="text-muted">
            Running timers and past machine runtime
        </p>
    </div>


    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3">Machine</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Runtime</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($meters as $meter)

                        <tr>

                            <td class="ps-3 fw-semibold">
                                {{ $meter->machine->name ?? 'Unknown' }}
                            </td>

                            <td>
                                {{ $meter->created_at }}
                            </td>

                            <td>
                                {{ $meter->updated_at ?? '-' }}
                            </td>


                            <td>

                                <span class="meter-timer"
                                    data-start="{{ $meter->start_time->timestamp }}"
                                    data-end="{{ $meter->end_time ? $meter->end_time->timestamp : '' }}"
                                    data-status="{{ $meter->machine->status }}">
                                    00:00:00
                                </span>

                            </td>

                            <td>
                                {{ $meter->created_at->format('Y-m-d') }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



<script>

document.addEventListener('DOMContentLoaded', function() {

    let timers =
    document.querySelectorAll('.meter-timer');

    setInterval(() => {

        timers.forEach(span => {

            let start =
            parseInt(span.dataset.start);

            let end =
            span.dataset.end
            ? parseInt(span.dataset.end)
            : null;

            let status =
            span.dataset.status;

            let seconds = 0;

            if(status === 'running'){

                seconds =
                Math.floor(Date.now()/1000)
                - start;

            }
            else if(status === 'standby'){

                seconds =
                Math.floor(Date.now()/1000)
                - start;

            }
            else if(status === 'shutdown'
                 || status === 'faulty'){

                if(end){
                    seconds = end - start;
                }

            }

            if(seconds < 0) seconds = 0;

            let h =
            String(Math.floor(seconds/3600))
            .padStart(2,'0');

            let m =
            String(Math.floor((seconds%3600)/60))
            .padStart(2,'0');

            let s =
            String(seconds%60)
            .padStart(2,'0');

            span.innerText =
            `${h}:${m}:${s}`;

        });

    }, 1000);

});

</script>

@endsection