@extends('layouts.app')

@section('content')

<style>
    /* Fix for unwanted carousel arrows */
    .carousel-control-prev,
    .carousel-control-next {
        display: none !important;
    }
</style>

<div class="page-header">
    <h3><i class="fas fa-upload me-2"></i>Biometric Data</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active">Upload Biometric Data</li>
        </ol>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Upload Form Card -->
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0 text-white">
            <i class="fas fa-file-upload me-2"></i>Upload CSV File
        </h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('biometric.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Select Month</label>
                    <select name="log_month" class="form-select" required>
                        <option value="">-- Month --</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Select Year</label>
                    <select name="log_year" class="form-select" required>
                        <option value="">-- Year --</option>
                        @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>

            </div>


            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-file-csv me-2"></i>Select CSV File
                        </label>
                        <input type="file" 
                               name="csv_file" 
                               class="form-control @error('csv_file') is-invalid @enderror" 
                               accept=".csv" 
                               required>
                        
                        @error('csv_file')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror

                        <small class="form-text text-muted mt-2 d-block">
                            <i class="fas fa-info-circle me-1"></i>
                            Accepted format: CSV file with biometric log data
                        </small>
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Data
                    </button>
                </div>
            </div>
        </form>

        <!-- Instructions -->
        <div class="alert alert-info mt-3 mb-0" style="background: #e0f2fe; border: 1px solid #bae6fd;">
            <h6 class="alert-heading mb-2">
                <i class="fas fa-lightbulb me-2"></i>CSV File Requirements:
            </h6>
            <ul class="mb-0 small" style="padding-left: 1.5rem;">
                <li>File must be in CSV format (.csv)</li>
                <li>Required columns: PIN, Date/Time, In/Out Mode</li>
                <li>Ensure employee PINs match biometric numbers in the system</li>
            </ul>
        </div>
    </div>
</div>

<!-- Delete Logs Card -->
<div class="card shadow-sm mb-4 mt-4">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0"><i class="fas fa-trash-alt me-2"></i>Delete Logs by Month & Year</h5>
    </div>

    <div class="card-body p-4">
        <form action="{{ route('biometric.delete') }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete all logs for the selected month and year? This action cannot be undone.');">

            @csrf
            @method('DELETE')

            <div class="row">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Select Month</label>
                    <select name="delete_month" class="form-select" required>
                        <option value="">-- Month --</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}">{{ date('F', mktime(0,0,0,$m,1)) }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Select Year</label>
                    <select name="delete_year" class="form-select" required>
                        <option value="">-- Year --</option>
                        @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-danger w-100 mt-2">
                        <i class="fas fa-trash me-2"></i>Delete Logs
                    </button>
                </div>
            </div>

            <p class="text-muted small mt-2">
                <i class="fas fa-info-circle me-1"></i>
                This will permanently delete <strong>all biometric logs</strong> stored for the selected month and year.
            </p>

        </form>
    </div>
</div>


<!-- Export Single Employee Logs -->
<div class="card shadow-sm mb-4 mt-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Export Employee Logs to PDF</h5>
    </div>

    <div class="card-body">
        <p class="text-muted mb-2">
            Export biometric logs for <strong>a specific employee</strong> for the selected month and year.
        </p>

        <a href="{{ route('biometric.select') }}" class="btn btn-primary">
            <i class="fas fa-arrow-right me-2"></i>Open Export Form
        </a>
    </div>
</div>



<!-- Biometric Logs Card -->
<div class="card shadow-sm">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">
                <i class="fas fa-history me-2"></i>Biometric Log Records
            </h5>
            <span class="badge bg-light text-dark">{{ $logs->total() }} Records</span>
        </div>
    </div>

    <div class="card-body p-0">
        @if($logs->count() === 0)
            <div class="text-center py-5">
                <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                <p class="text-muted mb-0">No biometric logs found.</p>
                <p class="text-muted small">Upload a CSV file to see log records here.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-id-badge me-2"></i>PIN</th>
                            <th><i class="fas fa-user me-2"></i>Employee Name</th>
                            <th><i class="fas fa-clock me-2"></i>Log Time</th>
                            <th><i class="fas fa-sign-in-alt me-2"></i>Time In / Out</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($logs as $log)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $log->pin }}</span>
                            </td>

                            <td>
                                @if($log->employee)
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 35px; height: 35px;">
                                            <span class="text-primary fw-bold">
                                                {{ strtoupper(substr($log->employee->full_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <strong>{{ $log->employee->full_name }}</strong>
                                    </div>
                                @else
                                    <span class="text-danger">
                                        <i class="fas fa-exclamation-triangle me-1"></i>Unknown Employee
                                    </span>
                                @endif
                            </td>

                            <td>
                                <i class="far fa-calendar-alt me-2 text-muted"></i>
                                {{ \Carbon\Carbon::parse($log->log_time)->format('M d, Y - h:i A') }}
                            </td>

                            <td>
                                @if($log->in_out_mode == 0)
                                    <span class="badge bg-success">
                                        <i class="fas fa-sign-in-alt me-1"></i>Time In
                                    </span>
                                @elseif($log->in_out_mode == 1)
                                    <span class="badge bg-danger">
                                        <i class="fas fa-sign-out-alt me-1"></i>Time Out
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-question-circle me-1"></i>Other ({{ $log->in_out_mode }})
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} logs
                    </small>
                    {{ $logs->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection