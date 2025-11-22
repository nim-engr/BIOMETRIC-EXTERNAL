@extends('layouts.app')

@section('content')

<h3>Upload Biometric Data</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow p-4 mb-4">
    <form action="{{ route('biometric.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Select CSV File:</label>
            <input type="file" name="csv_file" class="form-control" required>

            @error('csv_file')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-primary">Upload</button>
    </form>
</div>

<hr>

<h4>Biometric Log Records</h4>

<div class="card shadow p-4">
    @if($logs->count() === 0)
        <p class="text-muted">No biometric logs found.</p>
    @else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>PIN</th>
                <th>Employee Name</th>
                <th>Log Time</th>
                <th>Time In / Out</th>
            </tr>
        </thead>

        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->pin }}</td>

                <td>
                    @if($log->employee)
                        {{ $log->employee->full_name }}
                    @else
                        <span class="text-danger">Unknown Employee</span>
                    @endif
                </td>

                <td>{{ $log->log_time }}</td>

                <td>
                    @if($log->in_out_mode == 0)
                        <span class="badge bg-success">Time In</span>
                    @elseif($log->in_out_mode == 1)
                        <span class="badge bg-danger">Time Out</span>
                    @else
                        <span class="badge bg-secondary">Other ({{ $log->in_out_mode }})</span>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

    {{ $logs->links() }}
    @endif
</div>

@endsection
