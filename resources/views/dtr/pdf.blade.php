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

            <div class="dtr-form2">
                <div style="font-size:11px; font-weight:bold; text-align:left;">Civil Service Form No. 48</div>
                <div style="font-size:20px; font-weight:bold; text-align:center; margin-top:3px;">DAILY TIME RECORD</div>
                <div class="center" style="font-size:12px; font-weight:bold; text-align:center; margin-top:8px;">
                    <span class="line">
                        {{ strtoupper(
                            $employee->first_name . ' ' .
                            ($employee->middle_initial ? rtrim($employee->middle_initial, '.') . '. ' : '') .
                            $employee->family_name
                        ) }}
                    </span>
            </div>
                


                <div class="center" style="margin-top:10px;">
                    For the month of <span class="line">{{ strtoupper($month) }} {{ $year }}</span>
                </div>

                <div class="small" style="margin-top:10px;">
                    <p>
                        Official hours for&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Regular days
                        <span style="display:inline-block; width:60px; border-bottom:1px solid #000;"></span>
                        <br>
                        arrival and departure&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saturdays
                        <span style="display:inline-block; width:60px; border-bottom:1px solid #000;"></span>
                    </p>
                </div>

                <table>
                    <thead>
                            <tr>
                                <!-- Day column -->
                                <th rowspan="2" style="width:10%;">Day</th>

                                <!-- A.M. -->
                                <th colspan="2">A.M.</th>

                                <!-- P.M. -->
                                <th colspan="2">P.M.</th>

                                <!-- Undertime -->
                                <th colspan="2">Undertime</th>
                            </tr>

                            <tr>
                                <!-- A.M. sub-columns -->
                                <th>Arrival</th>
                                <th>Departure</th>

                                <!-- P.M. sub-columns -->
                                <th>Arrival</th>
                                <th>Departure</th>

                                <!-- Undertime sub-columns -->
                                <th>Hours</th>
                                <th>Minutes</th>
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
                            <td></td>
                        </tr>
                        @endfor

                        <tr>
                            <td colspan="5" class="bold">Total</td>
                            <td></td>
                            <td></td>
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
                </div>
                <br>
                <p class="small" style="margin-top:15px;">VERIFIED as to the prescribed office hours:</p>

                <div class="signature-space">
                    <div class="center" style="font-size:12px; font-weight:bold; text-align:center; margin-top:8px;">
                            <div class="small"><span class="line"> {{ strtoupper($employee->supervisor_full_name ?? '') }}</span><br>
                                <i>In Charge</i>
                            </div>
                    </div>
                </div>

            </div>

        </td>




        {{-- RIGHT SIDE --}}
        <td style="width:50%; vertical-align:top; padding-left:10px;">

            <div class="dtr-form2">
                <div style="font-size:11px; font-weight:bold; text-align:left;">Civil Service Form No. 48</div>
                <div style="font-size:20px; font-weight:bold; text-align:center; margin-top:3px;">DAILY TIME RECORD</div>
                <div class="center" style="font-size:12px; font-weight:bold; text-align:center; margin-top:8px;">
                    <span class="line">
                        {{ strtoupper(
                            $employee->first_name . ' ' .
                            ($employee->middle_initial ? rtrim($employee->middle_initial, '.') . '. ' : '') .
                            $employee->family_name
                        ) }}
                    </span>
            </div>
                


                <div class="center" style="margin-top:10px;">
                    For the month of <span class="line">{{ strtoupper($month) }} {{ $year }}</span>
                </div>

                <div class="small" style="margin-top:10px;">
                    <p>
                        Official hours for&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Regular days
                        <span style="display:inline-block; width:60px; border-bottom:1px solid #000;"></span>
                        <br>
                        arrival and departure&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Saturdays
                        <span style="display:inline-block; width:60px; border-bottom:1px solid #000;"></span>
                    </p>
                </div>

                <table>
                    <thead>
                            <tr>
                                <!-- Day column -->
                                <th rowspan="2" style="width:10%;">Day</th>

                                <!-- A.M. -->
                                <th colspan="2">A.M.</th>

                                <!-- P.M. -->
                                <th colspan="2">P.M.</th>

                                <!-- Undertime -->
                                <th colspan="2">Undertime</th>
                            </tr>

                            <tr>
                                <!-- A.M. sub-columns -->
                                <th>Arrival</th>
                                <th>Departure</th>

                                <!-- P.M. sub-columns -->
                                <th>Arrival</th>
                                <th>Departure</th>

                                <!-- Undertime sub-columns -->
                                <th>Hours</th>
                                <th>Minutes</th>
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
                            <td></td>
                        </tr>
                        @endfor

                        <tr>
                            <td colspan="5" class="bold">Total</td>
                            <td></td>
                            <td></td>
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
                </div>
                <br>
                <p class="small" style="margin-top:15px;">VERIFIED as to the prescribed office hours:</p>

                <div class="signature-space">
                    <div class="center" style="font-size:12px; font-weight:bold; text-align:center; margin-top:8px;">
                            <div class="small"><span class="line"> {{ strtoupper($employee->supervisor_full_name ?? '') }}</span><br>
                                <i>In Charge</i>
                            </div>
                    </div>
                </div>

            </div>

        </td>

    </tr>
</table>

</body>

</html>
