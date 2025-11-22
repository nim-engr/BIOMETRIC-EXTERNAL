<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\BiometricLog;

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
            'csv_file' => 'required|mimes:csv,txt|max:4096',
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

            $employee = Employee::where('biometric_number', $pin)->first();

            if (!$employee) {
                $skipped++;
                continue;
            }

            BiometricLog::create([
                'employee_id' => $employee->id,
                'pin'         => $pin,
                'log_time'    => $timestamp,
                'verify_mode' => $verify,
                'in_out_mode' => $inout,
                'work_code'   => $w1,
                'reserved'    => $w2,
            ]);

            $imported++;
        }

        return redirect()->route('biometric.upload')
                 ->with('success', "Upload complete. Imported: $imported | Skipped: $skipped");

    }
}
