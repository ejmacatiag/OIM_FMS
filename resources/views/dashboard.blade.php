@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Dashboard heading stays on the left -->
    <h1 class="mb-4">Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Centered Summary Cards -->
    <div class="row justify-content-center">
        <!-- Total Files -->
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-solid fa-folder fa-3x text-primary"></i>
                    </div>
                    <div>
                        <p class="text-primary fw-semibold mb-1 small">Total Files</p>
                        <p class="mb-0 fs-4 text-dark">{{ $totalFiles }} Files</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Offices -->
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fa-solid fa-building fa-3x text-info"></i>
                    </div>
                    <div>
                        <p class="text-info fw-semibold mb-1 small">Total Office</p>
                        <p class="mb-0 fs-4 text-dark">{{ $totalOffices }} Office</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin & Finance Section -->
    <h3 class="text-center mt-5 fw-bold">Admin & Finance Section</h3>
    <div class="row mt-4 justify-content-center text-center">

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Admin Unit']) }}">
                <img src="{{ asset('storage/images/admin.png') }}" alt="Admin Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Admin Unit</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Cashiering Unit']) }}">
                <img src="{{ asset('storage/images/cashier.png') }}" alt="Cashiering Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Cashiering Unit</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Finance Unit']) }}">
                <img src="{{ asset('storage/images/finance.png') }}" alt="Finance Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Finance Unit</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Property Unit']) }}">
                <img src="{{ asset('storage/images/property.png') }}" alt="Property Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Property Unit</p>
        </div>

    </div>

    <!-- Engineering Section -->
    <h1 class="text-center mt-5 fw-bold">Engineering Section</h1>
    <div class="row mt-4 justify-content-center text-center">

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Planning Unit']) }}">
                <img src="{{ asset('storage/images/planning.png') }}" alt="Planning Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Planning Unit</p>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Design Unit']) }}">
                <img src="{{ asset('storage/images/design.png') }}" alt="Design Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Design Unit</p>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Construction Unit']) }}">
                <img src="{{ asset('storage/images/construction.png') }}" alt="Construction Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Construction Unit</p>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Institutional Development Unit']) }}">
                <img src="{{ asset('storage/images/idu.png') }}" alt="Institutional Development Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Institutional Development Unit</p>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Equipment Unit']) }}">
                <img src="{{ asset('storage/images/equipment.png') }}" alt="Equipment Unit"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Equipment Unit</p>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Survey Team']) }}">
                <img src="{{ asset('storage/images/survey.png') }}" alt="Survey Team"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Survey Team</p>
        </div>

        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'SRIP']) }}">
                <img src="{{ asset('storage/images/SRIP.png') }}" alt="SRIP"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">SRIP</p>
        </div>

    </div>

    <!-- Operation & Maintenance Section -->
    <h3 class="text-center mt-5 fw-bold">Operation & Maintenance</h3>
    <div class="row mt-4 justify-content-center text-center">

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'ASRIS']) }}">
                <img src="{{ asset('storage/images/ASRIS.png') }}" alt="ASRIS"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">ASRIS</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'SFDRIS']) }}">
                <img src="{{ asset('storage/images/SFDRIS.png') }}" alt="SFDRIS"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">SFDRIS</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'LARIS']) }}">
                <img src="{{ asset('storage/images/LARIS.png') }}" alt="LARIS"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">LARIS</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'ADRIS']) }}">
                <img src="{{ asset('storage/images/ADRIS.png') }}" alt="ADRIS"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">ADRIS</p>
        </div>

    </div>

    <!-- Other Offices Section -->
    <h3 class="text-center mt-5 fw-bold">Other Offices</h3>
    <div class="row mt-4 justify-content-center text-center">

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'Regional Office']) }}">
                <img src="{{ asset('storage/images/admin.png') }}" alt="Regional Office"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Regional Office</p>
        </div>

        <div class="col-6 col-md-3 mb-4">
            <a href="{{ route('files.office', ['unit' => 'agencies']) }}">
                <img src="{{ asset('storage/images/cashier.png') }}" alt="Other Agencies"
                    class="img-fluid rounded shadow image-hover mx-auto d-block"
                    style="max-width: 200px;">
            </a>
            <p class="mt-2 fw-semibold text-dark">Other Agencies</p>
        </div>

    </div>


</div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
