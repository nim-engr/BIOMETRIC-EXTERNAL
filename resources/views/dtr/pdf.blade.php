<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DTR - {{ $employee->first_name }} {{ $employee->family_name }}</title>

    <style>
        @page { size: A4 portrait; margin: 15px 20px; }

        body {
            font-family: "Times New Roman", serif;
            font-size: 11px;
        }

        .page-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .dtr-form {
            width: 48%;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-bottom: 1px solid #000;
            display: inline-block;
            width: 150px;
            height: 12px;
            vertical-align: bottom;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 2px;
            font-size: 10px;
        }

        .no-border {
            border: none !important;
        }

        .signature-space {
            margin-top: 20px;
            text-align: center;
        }

        .sig-line {
            margin-top: 25px;
            width: 220px;
            border-top: 1px solid #000;
            margin-left: auto;
            margin-right: auto;
            height: 2px;
        }

        .small {
            font-size: 10px;
        }

    </style>
</head>

<body>

<table style="width:100%; border:none; border-collapse:collapse;">
    <tr>

        {{-- LEFT SIDE --}}
        <td style="width:50%; vertical-align:top; padding-right:10px;">

            <div class="dtr-form1">

                <div class="center bold" style="font-size:14px;">DAILY TIME RECORD</div>
                
                <div class="center bold" style="font-size:10px;">( {{ $employee->first_name }} {{ $employee->family_name }} )</div>

                <div class="center" style="margin-top:10px;">
                    For the month of <span class="line">{{ strtoupper($month) }} {{ $year }}</span>
                </div>

                <div class="small" style="margin-top:10px;">
                    Official hours for<br>
                    arrival and departure<br>
                    Regular days <span class="line" style="width:120px;"></span><br>
                    Saturdays <span class="line" style="width:120px;"></span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:12%;">Day</th>
                            <th colspan="2">A.M.</th>
                            <th colspan="2">P.M.</th>
                            <th rowspan="2">Undertime<br>Hours<br>Minutes</th>
                        </tr>
                        <tr>
                            <th>Arrival</th>
                            <th>Depar-<br>ture</th>
                            <th>Arrival</th>
                            <th>Depar-<br>ture</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for($d=1; $d<=31; $d++)
                        <tr>
                            <td>{{ $d }}</td>
                            <td>{{ $dtr[$d]['am_in'] ?? '' }}</td>
                            <td>{{ $dtr[$d]['am_out'] ?? '' }}</td>
                            <td>{{ $dtr[$d]['pm_in'] ?? '' }}</td>
                            <td>{{ $dtr[$d]['pm_out'] ?? '' }}</td>
                            <td></td>
                        </tr>
                        @endfor

                        <tr>
                            <td colspan="6" class="bold">Total</td>
                        </tr>
                    </tbody>
                </table>

                <p class="small" style="margin-top:8px;">
                    I certify on my honor that the above is a true and correct report of<br>
                    the hours of work performed, record of which was made daily at the<br>
                    time of arrival and departure from office.
                </p>

                <div class="signature-space">
                    <div class="sig-line"></div>
                    <div class="small">EMPLOYEE SIGNATURE</div>
                </div>

                <p class="small" style="margin-top:15px;">VERIFIED as to the prescribed office hours:</p>

                <div class="signature-space">
                    <div class="sig-line"></div>
                    <div class="small">
                        EMPLOYEE SUPERVISOR<br>
                        {{ $employee->supervisor_full_name ?? '' }}<br>
                        <i>In Charge</i>
                    </div>
                </div>

            </div>

        </td>




        {{-- RIGHT SIDE --}}
        <td style="width:50%; vertical-align:top; padding-left:10px;">

            <div class="dtr-form2">

                <div class="center bold" style="font-size:14px;">DAILY TIME RECORD</div>
                <div class="center bold" style="margin-top:5px;">EMPLOYEE NAME</div>
                <div class="center">( {{ $employee->first_name }} {{ $employee->family_name }} )</div>

                <div class="center" style="margin-top:10px;">
                    For the month of <span class="line">{{ strtoupper($month) }} {{ $year }}</span>
                </div>

                <div class="small" style="margin-top:10px;">
                    Official hours for<br>
                    arrival and departure<br>
                    Regular days <span class="line" style="width:120px;"></span><br>
                    Saturdays <span class="line" style="width:120px;"></span>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width:12%;">Day</th>
                            <th colspan="2">A.M.</th>
                            <th colspan="2">P.M.</th>
                            <th rowspan="2">Undertime<br>Hours<br>Minutes</th>
                        </tr>
                        <tr>
                            <th>Arrival</th>
                            <th>Depar-<br>ture</th>
                            <th>Arrival</th>
                            <th>Depar-<br>ture</th>
                        </tr>
                    </thead>

                    <tbody>
                        @for($d=1; $d<=31; $d++)
                        <tr>
                            <td>{{ $d }}</td>
                            <td>{{ $dtr[$d]['am_in'] ?? '' }}</td>
                            <td>{{ $dtr[$d]['am_out'] ?? '' }}</td>
                            <td>{{ $dtr[$d]['pm_in'] ?? '' }}</td>
                            <td>{{ $dtr[$d]['pm_out'] ?? '' }}</td>
                            <td></td>
                        </tr>
                        @endfor

                        <tr>
                            <td colspan="6" class="bold">Total</td>
                        </tr>
                    </tbody>
                </table>

                <p class="small" style="margin-top:8px;">
                    I certify on my honor that the above is a true and correct report of<br>
                    the hours of work performed, record of which was made daily at the<br>
                    time of arrival and departure from office.
                </p>

                <div class="signature-space">
                    <div class="sig-line"></div>
                    <div class="small">EMPLOYEE SIGNATURE</div>
                </div>

                <p class="small" style="margin-top:15px;">VERIFIED as to the prescribed office hours:</p>

                <div class="signature-space">
                    <div class="sig-line"></div>
                    <div class="small">
                        EMPLOYEE SUPERVISOR<br>
                        {{ $employee->supervisor_full_name ?? '' }}<br>
                        <i>In Charge</i>
                    </div>
                </div>

            </div>

        </td>

    </tr>
</table>

</body>

</html>
