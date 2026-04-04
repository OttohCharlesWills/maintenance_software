@extends('layouts.admin')

@section('admincontent')

<div class="card" style="margin-left: 20px; margin-top: 20px; width:70vw;">

<div class="card-header">
    Production Reports
</div>
<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>
<th>Machine</th>
<th>Operator</th>
<th>BS&W</th>
<th>Gross</th>
<th>Net</th>
<th>Date</th>
</tr>

</thead>

<tbody>

@foreach($reports as $report)

<tr>

<td>{{ $report->machine->name }}</td>

<td>{{ $report->operator->name }}</td>

<td>{{ $report->bsw }}</td>

<td>{{ $report->gross }}</td>

<td>{{ $report->net }}</td>

<td>{{ $report->report_date }}</td>

</tr>

@endforeach

</tbody>

</table>    
</div>

</div>

@endsection