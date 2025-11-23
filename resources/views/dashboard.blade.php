@extends('layouts.app')

@section('content')

<div class="page-header">
    <h3><i class="fas fa-th-large me-2"></i>Employee Dashboard</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Total Employees</p>
                        <h3 class="mb-0 fw-bold">{{ $employees->total() }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Active Today</p>
                        <h3 class="mb-0 fw-bold">--</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="fas fa-user-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">On Leave</p>
                        <h3 class="mb-0 fw-bold">--</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="fas fa-user-clock fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Departments</p>
                        <h3 class="mb-0 fw-bold">--</h3>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="fas fa-building fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Employee List Card -->
<div class="card shadow-sm">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">
                <i class="fas fa-list me-2"></i>List of Employees
            </h5>
            <a href="{{ route('employee.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus me-1"></i>Manage
            </a>
        </div>
    </div>

    <div class="card-body p-0">
        @if($employees->count() === 0)
            <div class="text-center py-5">
                <i class="fas fa-users fa-4x text-muted mb-3"></i>
                <p class="text-muted mb-0">No employees found.</p>
                <a href="{{ route('employee.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-2"></i>Add First Employee
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>Biometric No.</th>
                            <th><i class="fas fa-user me-2"></i>Name</th>
                            <th><i class="fas fa-briefcase me-2"></i>Position</th>
                            <th><i class="fas fa-info-circle me-2"></i>Status</th>
                            <th><i class="fas fa-user-tie me-2"></i>Supervisor</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($employees as $emp)
                        <tr>
                            <td>
                                <span class="badge bg-secondary">{{ $emp->biometric_number }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" 
                                         style="width: 35px; height: 35px;">
                                        <span class="text-primary fw-bold">
                                            {{ strtoupper(substr($emp->full_name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <strong>{{ $emp->full_name }}</strong>
                                </div>
                            </td>
                            <td>{{ $emp->position }}</td>
                            <td>
                                @if($emp->employment_status == 'Active')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i>{{ $emp->employment_status }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">{{ $emp->employment_status }}</span>
                                @endif
                            </td>
                            <td>{{ $emp->supervisor_full_name ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} employees
                    </small>
                    {{ $employees->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection