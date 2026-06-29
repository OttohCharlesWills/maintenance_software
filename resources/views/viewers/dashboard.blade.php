@extends('layouts.viewer')

@section('viewercontent')

<div class="container-fluid py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body text-center p-5">

                    <div style="font-size:70px;">👀</div>

                    <h2 class="fw-bold mt-3">
                        Welcome, {{ auth()->user()->name }}
                    </h2>

                    <p class="text-muted mb-4">
                        Viewer Dashboard
                    </p>

                    <hr>

                    <p class="fs-5 text-secondary">
                        This account has <strong>View Only</strong> access.
                    </p>

                    <p class="text-muted">
                        You can monitor machine statuses, equipment, meter logs,
                        maintenance reports, production reports, and other system
                        information. Changes to the system such as creating,
                        editing, deleting, or updating records are restricted.
                    </p>

                    <div class="alert alert-info mt-4 mb-0">
                        <strong>Note:</strong> Contact your administrator if you
                        require additional permissions.
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection