<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\BiometricLog;
use Barryvdh\DomPDF\Facade\Pdf;


class BiometricController extends Controller
{
    public function index()
    {
    
    // Get logs from newest to oldest (or change to asc if you want first → last)
    $logs = \App\Models\BiometricLog::with('employee')->orderBy('log_time', 'desc')->paginate(20);

    return view('biometric.upload', compact('logs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'log_month' => 'required|integer|min:1|max:12',
            'log_year'  => 'required|integer|min:2000|max:2100',
            'csv_file'  => 'required|mimes:csv,txt|max:4096',
        ]);

        $file = $request->file('csv_file');
        $rows = file($file->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $imported = 0;
        $skipped = 0;

        foreach ($rows as $line) {

            $line = str_replace('"', '', $line);
            $parts = preg_split('/\t+/', trim($line));

            if (count($parts) < 2) {
                $skipped++;
                continue;
            }

            $pin       = trim($parts[0]);
            $timestamp = trim($parts[1]);
            $verify    = $parts[2] ?? null;
            $inout     = $parts[3] ?? null;
            $w1        = $parts[4] ?? null;
            $w2        = $parts[5] ?? null;

            // Assign employee via PIN
            $employee = Employee::where('biometric_number', $pin)->first();

            if (!$employee) {
                $skipped++;
                continue;
            }

            BiometricLog::create([
                'employee_id' => $employee->id,
                'pin'         => $pin,
                'log_time'    => $timestamp,
                'log_month'   => $request->log_month,
                'log_year'    => $request->log_year,
                'verify_mode' => $verify,
                'in_out_mode' => $inout,
                'work_code'   => $w1,
                'reserved'    => $w2,
            ]);

            $imported++;
        }

        return redirect()
            ->route('biometric.upload')
            ->with('success', "Biometric upload complete. Imported: $imported | Skipped: $skipped");
    }

    public function deleteByMonthYear(Request $request)
    {
        $request->validate([
            'delete_month' => 'required|integer|min:1|max:12',
            'delete_year'  => 'required|integer|min:2000|max:2100',
        ]);

        $month = $request->delete_month;
        $year  = $request->delete_year;

        // Count logs before deletion
        $count = \App\Models\BiometricLog::where('log_month', $month)
                    ->where('log_year', $year)
                    ->count();

        if ($count === 0) {
            return back()->with('success', "No logs found for $month/$year.");
        }

        // Perform deletion
        \App\Models\BiometricLog::where('log_month', $month)
            ->where('log_year', $year)
            ->delete();

        return back()->with('success', "Successfully deleted $count log(s) for $month/$year.");
    }
    
    
    public function selectForPdf()
    {
        $employees = \App\Models\Employee::orderBy('family_name')
                                    ->orderBy('first_name')
                                    ->get();

        return view('biometric.select', compact('employees'));
    }

    public function exportEmployeePdf(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'month'     => 'required|integer|min:1|max:12',
            'year'      => 'required|integer|min:2000|max:2100',
        ]);

        // Split full name into first + last
        $nameParts = explode('|', $request->full_name); // safer delimiter
        $firstName = $nameParts[0];
        $familyName = $nameParts[1];

        // Find employee using both first_name and family_name
        $employee = \App\Models\Employee::where('first_name', $firstName)
                    ->where('family_name', $familyName)
                    ->firstOrFail();

        // Now fetch logs
        $logs = \App\Models\BiometricLog::where('employee_id', $employee->id)
                    ->where('log_month', $request->month)
                    ->where('log_year', $request->year)
                    ->orderBy('log_time')
                    ->get();

        $monthName = date('F', mktime(0, 0, 0, $request->month, 1));

        $pdf = Pdf::loadView('biometric.employee_pdf', [
            'employee' => $employee,
            'logs'     => $logs,
            'month'    => $monthName,
            'year'     => $request->year,
        ])->setPaper('A4', 'portrait');

        return $pdf->download("{$employee->full_name}_{$monthName}_{$request->year}_logs.pdf");
    }

}
