@extends('layouts.superadmin')

@section('supercontent')

<div class="card">

<div class="card-header">
       Production Reports
</div>
<div class="card-body">
       
<form method="GET" class="mb-3">

<div class="row">

<div class="col-md-4">
<label>Select Shop</label>

<select name="location_id" class="form-control">

<option value="">All Shops</option>

@foreach($locations as $location)

<option value="{{ $location->id }}"
@if($location_id == $location->id) selected @endif>

{{ $location->name }}

</option>

@endforeach

</select>

</div>


<div class="col-md-4">

<label>Select Date</label>

<input type="date"
       name="date"
       value="{{ $date }}"
       class="form-control">

</div>


<div class="col-md-4" style="margin-top:30px">

<button class="btn btn-primary">
Filter Report
</button>

</div>

</div>

</form>


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