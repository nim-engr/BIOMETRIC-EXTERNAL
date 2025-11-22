@extends('layouts.app')

@section('content')

<h3 class="mb-4">Employee Dashboard</h3>

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Employees (First to Last)</h5>
    </div>

    <div class="card-body">

        @if($employees->count() === 0)
            <p class="text-muted">No employees found.</p>
        @else

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Biometric No.</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Supervisor</th>
                </tr>
            </thead>

            <tbody>
                @foreach($employees as $emp)
                <tr>
                    <td>{{ $emp->biometric_number }}</td>
                    <td>{{ $emp->full_name }}</td>
                    <td>{{ $emp->position }}</td>
                    <td>{{ $emp->employment_status }}</td>
                    <td>{{ $emp->supervisor_full_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $employees->links() }}

        @endif
    </div>
</div>

@endsection
