<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 4px; text-align: center; }
        .header { text-align: center; font-weight: bold; margin-bottom: 10px; }
        .info td { border: none; text-align: left; }
        .signature { margin-top: 40px; text-align: center; }
        .signature-line { margin-top: 50px; border-top: 1px solid #000; width: 200px; margin-left: auto; margin-right: auto; }
    </style>
</head>

<body>

<div class="header">DAILY TIME RECORD</div>

<table class="info">
    <tr>
        <td><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->family_name }}</td>
    </tr>
    <tr>
        <td><strong>Date:</strong> {{ $month }} {{ $year }}</td>
    </tr>
</table>

<br>

<table>
    <thead>
        <tr>
            <th rowspan="2">Day</th>
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
                <td>{{ $row['am_in'] ?? '' }}</td>
                <td>{{ $row['am_out'] ?? '' }}</td>
                <td>{{ $row['pm_in'] ?? '' }}</td>
                <td>{{ $row['pm_out'] ?? '' }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<div class="signature">
    <p>I CERTIFY on my honor that the above is true and correct report<br>
    of hours of work performed, record of which was made daily at the<br>
    time of arrival and departure from office.</p>

    <div class="signature-line"></div>
    <p>Employee Signature</p>
</div>

</body>
</html>
