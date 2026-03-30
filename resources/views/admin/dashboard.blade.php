@extends('layouts.admin')

@section('admincontent')



    <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <span>
            Welcome, {{ Auth::user()->name }} To Your Dashboard
        </span>
    </nav>

    <br>

    <div class="container-fluid">


    </div>

@endsection