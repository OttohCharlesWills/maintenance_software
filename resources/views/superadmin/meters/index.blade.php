@extends('layouts.superadmin')

@section('supercontent')

<div class="container">


    {{-- PAGE TITLE --}}
    <h2>Machine Meter Records</h2>

        @foreach($meters as $meter)
            <span class="meter-timer"
                data-start="{{ $meter->start_time->timestamp }}"
                data-end="{{ $meter->end_time ? $meter->end_time->timestamp : '' }}"
                data-status="{{ $meter->machine->status }}">
                00:00:00
            </span>
        @endforeach

    {{-- METER TABLE --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Machine</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Runtime</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($meters as $meter)
                    <tr>
                        {{-- MACHINE NAME --}}
                        <td>{{ $meter->machine->name ?? 'Unknown' }}</td>

                        {{-- START TIME --}}
                        <td>{{ $meter->created_at }}</td>

                        {{-- END TIME --}}
                        <td>{{ $meter->updated_at ?? '-' }}</td>
                    

                        <td>    
                            @php
                                $start = \Carbon\Carbon::parse($meter->updated_at);
                                $end = \Carbon\Carbon::parse($meter->created_at);
                                $diff = $end->diffInSeconds($start);
                                $h = str_pad(floor($diff / 3600), 2, '0', STR_PAD_LEFT);
                                $m = str_pad(floor(($diff % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                $s = str_pad($diff % 60, 2, '0', STR_PAD_LEFT);
                            @endphp
                            {{ $h }}:{{ $m }}:{{ $s }}
                        </td>

                        {{-- DATE --}}
                        <td>{{ $meter->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- JS FOR LIVE TIMERS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    let timers = document.querySelectorAll('.meter-timer');

    setInterval(() => {
        timers.forEach(span => {
            let start = parseInt(span.dataset.start);
            let end = span.dataset.end ? parseInt(span.dataset.end) : null;
            let status = span.dataset.status;

            let seconds = 0;

            if(status === 'running'){
                seconds = Math.floor(Date.now()/1000) - start;
            } else if(status === 'standby'){
                // PAUSE: do not increment, keep current seconds
                seconds = Math.floor(Date.now()/1000) - start;
            } else if(status === 'shutdown' || status === 'faulty'){
                if(end){
                    seconds = end - start;
                }
            }

            if(seconds < 0) seconds = 0; // safety net

            let h = String(Math.floor(seconds/3600)).padStart(2,'0');
            let m = String(Math.floor((seconds%3600)/60)).padStart(2,'0');
            let s = String(seconds%60).padStart(2,'0');

            span.innerText = `${h}:${m}:${s}`;
        });
    }, 1000);
});
</script>

@endsection