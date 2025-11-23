<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\BiometricLog;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DtrController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('family_name')->orderBy('first_name')->get();
        return view('dtr.generate', ['employees' => $employees]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000|max:2100',
        ]);

        // Split first & last
        [$first, $last] = explode('|', $request->full_name);

        $employee = Employee::where('first_name', $first)
                            ->where('family_name', $last)
                            ->firstOrFail();

        // Get logs for that employee and month-year
        $logs = BiometricLog::where('employee_id', $employee->id)
                            ->where('log_month', $request->month)
                            ->where('log_year', $request->year)
                            ->orderBy('log_time')
                            ->get()
                            ->groupBy(function ($log) {
                                return Carbon::parse($log->log_time)->format('Y-m-d');
                            });

        // Prepare daily table
        $daysInMonth = Carbon::create($request->year, $request->month, 1)->daysInMonth;

        $dtr = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {

            $date = Carbon::create($request->year, $request->month, $day)->format('Y-m-d');
            $entries = $logs->get($date, collect());

            // Extract Time In / Time Out
            $amArrival = null;
            $amDeparture = null;
            $pmArrival = null;
            $pmDeparture = null;

            foreach ($entries as $log) {
                $time = Carbon::parse($log->log_time);

                // Determine AM/PM
                if ($time->format('A') === 'AM') {
                    if ($log->in_out_mode == 0 && !$amArrival) {
                        $amArrival = $time->format('g:i A');
                    } elseif ($log->in_out_mode == 1) {
                        $amDeparture = $time->format('g:i A');
                    }
                } else {
                    if ($log->in_out_mode == 0 && !$pmArrival) {
                        $pmArrival = $time->format('g:i A');
                    } elseif ($log->in_out_mode == 1) {
                        $pmDeparture = $time->format('g:i A');
                    }
                }
            }

            $dtr[$day] = [
                'am_in'  => $amArrival,
                'am_out' => $amDeparture,
                'pm_in'  => $pmArrival,
                'pm_out' => $pmDeparture,
            ];
        }

        return view('dtr.generate', [
            'employees' => Employee::orderBy('family_name')->get(),
            'employee'  => $employee,
            'month'     => $request->month,
            'year'      => $request->year,
            'dtr'       => $dtr,
        ]);
    }


    public function exportPdf(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000|max:2100',
        ]);

        [$first, $last] = explode('|', $request->full_name);

        $employee = Employee::where('first_name', $first)
                            ->where('family_name', $last)
                            ->firstOrFail();

        // regenerate DTR (same logic as generate method)
        $logs = BiometricLog::where('employee_id', $employee->id)
                            ->where('log_month', $request->month)
                            ->where('log_year', $request->year)
                            ->orderBy('log_time')
                            ->get()
                            ->groupBy(function ($log) {
                                return Carbon::parse($log->log_time)->format('Y-m-d');
                            });

        $daysInMonth = Carbon::create($request->year, $request->month, 1)->daysInMonth;
        $dtr = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {

            $date = Carbon::create($request->year, $request->month, $day)->format('Y-m-d');
            $entries = $logs->get($date, collect());

            $amArrival = null; $amDeparture = null;
            $pmArrival = null; $pmDeparture = null;

            foreach ($entries as $log) {
                $time = Carbon::parse($log->log_time);

                if ($time->format('A') === 'AM') {
                    if ($log->in_out_mode == 0 && !$amArrival) $amArrival = $time->format('g:i A');
                    if ($log->in_out_mode == 1) $amDeparture = $time->format('g:i A');
                } else {
                    if ($log->in_out_mode == 0 && !$pmArrival) $pmArrival = $time->format('g:i A');
                    if ($log->in_out_mode == 1) $pmDeparture = $time->format('g:i A');
                }
            }

            $dtr[$day] = [
                'am_in'  => $amArrival,
                'am_out' => $amDeparture,
                'pm_in'  => $pmArrival,
                'pm_out' => $pmDeparture,
            ];
        }

        $monthName = date('F', mktime(0, 0, 0, $request->month, 1));

        $pdf = Pdf::loadView('dtr.pdf', [
            'employee' => $employee,
            'dtr'      => $dtr,
            'month'    => $monthName,
            'year'     => $request->year,
        ])->setPaper('A4', 'portrait');

        return $pdf->download("DTR_{$employee->first_name}_{$employee->family_name}_{$monthName}_{$request->year}.pdf");
    }

}
