<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
        <h4 class="text-center mb-4">MENU</h4>
        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('employee.index') }}">
                    Employees
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('biometric.upload') }}">
                    Upload Biometric Data
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('dtr.generate') }}">
                    Generate DTR
                </a>
            </li>

        </ul>
    </div>

    <!-- Main Content -->
    <div class="p-4" style="flex:1;">
        @yield('content')
    </div>
</div>

</body>
</html>
