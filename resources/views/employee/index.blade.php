@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Employees</h3>
    <a href="{{ route('employee.create') }}" class="btn btn-success">+ Add Employee</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Biometric No.</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Supervisor</th>
                    <th>Action</th>
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
                    <td>
                        <a href="{{ route('employee.edit', $emp->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('employee.destroy', $emp->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this employee?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

        {{ $employees->links() }}

    </div>
</div>

@endsection
