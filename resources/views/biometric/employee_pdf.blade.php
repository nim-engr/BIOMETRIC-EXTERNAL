<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #555; padding: 6px; }
        th { background: #f0f0f0; }
        h2 { margin-bottom: 0; }
    </style>
</head>
<body>

<h2>Biometric Logs Report</h2>
<p>
    <strong>Employee:</strong> {{ $employee->full_name }}<br>
    <strong>Month:</strong> {{ $month }}<br>
    <strong>Year:</strong> {{ $year }}
</p>

<table>
    <thead>
        <tr>
            <th>Date & Time</th>
            <th>In/Out</th>
        </tr>
    </thead>
    <tbody>
        @foreach($logs as $log)
        <tr>
            <td>{{ \Carbon\Carbon::parse($log->log_time)->format('M d, Y h:i A') }}</td>
            <td>
                @if($log->in_out_mode == 0)
                    IN
                @elseif($log->in_out_mode == 1)
                    OUT
                @else
                    {{ $log->in_out_mode }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
