@extends('layouts.app')

@section('content')

<h3>Generate Daily Time Record (DTR)</h3>

<div class="card shadow-sm mb-4 p-4">

    <form action="{{ route('dtr.generate.run') }}" method="POST">
        @csrf

        <div class="row mb-3">

            <div class="col-md-4">
                <label class="form-label">Select Employee</label>
                <select name="full_name" class="form-select" required>
                    <option value="">-- Select Employee --</option>
                    @foreach($employees as $e)
                        <option value="{{ $e->first_name }}|{{ $e->family_name }}"
                            @if(isset($employee) && $employee->id === $e->id) selected @endif>
                            {{ $e->first_name }} {{ $e->family_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Select Month</label>
                <select name="month" class="form-select" required>
                    <option value="">-- Month --</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}"
                            @if(isset($month) && $month == $m) selected @endif>
                            {{ date('F', mktime(0,0,0,$m,1)) }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Select Year</label>
                <select name="year" class="form-select" required>
                    <option value="">-- Year --</option>
                    @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                        <option value="{{ $y }}"
                            @if(isset($year) && $year == $y) selected @endif>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    <i class="fas fa-file-alt me-2"></i>Generate
                </button>
            </div>

        </div>
    </form>

</div>


@if(isset($dtr))

<!-- Title -->
<h4 class="mb-3">Daily Time Record — {{ $employee->first_name }} {{ $employee->family_name }}</h4>

<div class="card shadow-sm p-4">

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th rowspan="2" style="width: 8%;">Day</th>
                <th colspan="2">A.M.</th>
                <th colspan="2">P.M.</th>
                <th rowspan="2">Undertime</th>
            </tr>
            <tr>
                <th>Arrival</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Departure</th>
            </tr>
        </thead>

        <tbody>
            @foreach($dtr as $day => $row)
                <tr>
                    <td>{{ sprintf('%02d', $day) }}</td>
                    <td>{{ $row['am_in']  ?? '' }}</td>
                    <td>{{ $row['am_out'] ?? '' }}</td>
                    <td>{{ $row['pm_in']  ?? '' }}</td>
                    <td>{{ $row['pm_out'] ?? '' }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

    <div class="mt-4">

        <form action="{{ route('dtr.generate.pdf') }}" method="GET">

            <input type="hidden" name="full_name" value="{{ $employee->first_name }}|{{ $employee->family_name }}">
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">

            <button class="btn btn-danger">
                <i class="fas fa-file-pdf me-2"></i>
                Generate Official DTR (CS Form 48)
            </button>

        </form>

    </div>


@endif

@endsection
