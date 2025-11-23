<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Biometric System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #2563eb;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8fafc;
            overflow-x: hidden;
        }

        /* Hide any unwanted carousel controls */
        .carousel-control-prev,
        .carousel-control-next,
        .carousel-indicators {
            display: none !important;
        }

        /* Ensure main content doesn't overflow */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #0f172a 100%);
            box-shadow: 4px 0 12px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .sidebar-header h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
            letter-spacing: 1px;
        }

        .sidebar-header p {
            color: #94a3b8;
            font-size: 0.75rem;
            margin: 0.25rem 0 0 0;
        }

        .nav-menu {
            padding: 1.5rem 0;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: #fff;
            border-left-color: var(--primary-color);
        }

        .nav-link.active {
            background: rgba(37, 99, 235, 0.15);
            color: #fff;
            border-left-color: var(--primary-color);
        }

        .nav-link i {
            width: 20px;
            margin-right: 0.875rem;
            font-size: 1.1rem;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h3 {
            color: #0f172a;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.875rem;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            border: none;
            border-radius: 12px 12px 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #334155;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8fafc;
        }

        .badge {
            padding: 0.5rem 0.875rem;
            font-weight: 500;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        .btn {
            padding: 0.625rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 0.625rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .pagination {
            margin-top: 1.5rem;
        }

        .page-link {
            border-radius: 8px;
            margin: 0 0.25rem;
            border: 1px solid #e2e8f0;
            color: #475569;
        }

        .page-link:hover {
            background: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-fingerprint"></i> BIOMETRIC</h4>
            <p>Employee Management System</p>
        </div>

        <ul class="nav flex-column nav-menu">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employee.*') ? 'active' : '' }}" href="{{ route('employee.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Employees</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('biometric.*') ? 'active' : '' }}" href="{{ route('biometric.upload') }}">
                    <i class="fas fa-upload"></i>
                    <span>Biometric Data</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dtr.*') ? 'active' : '' }}" href="{{ route('dtr.generate') }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Generate DTR</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>