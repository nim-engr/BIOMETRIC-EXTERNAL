@extends('layouts.app')

@section('content')

<h3>Export Employee Biometric Logs to PDF</h3>

<div class="card shadow-sm p-4">
    <form action="{{ route('biometric.export.pdf') }}" method="GET">

        <div class="row mb-3">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Select Employee</label>
                <select name="full_name" class="form-select" required>
                    <option value="">-- Select Employee --</option>
                    @foreach($employees as $emp)
                        <option value="{{ $emp->first_name }}|{{ $emp->family_name }}">
                            {{ $emp->first_name }} {{ $emp->family_name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Month</label>
                <select name="month" class="form-select" required>
                    <option value="">-- Month --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Select Year</label>
                <select name="year" class="form-select" required>
                    <option value="">-- Year --</option>
                    @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-danger w-100">
                    <i class="fas fa-file-pdf me-2"></i>Export PDF
                </button>
            </div>

        </div>

    </form>
</div>

@endsection
