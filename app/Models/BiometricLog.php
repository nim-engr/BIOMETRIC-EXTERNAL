<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiometricLog extends Model
{
    protected $fillable = [
        'employee_id',
        'pin',
        'log_time',
        'log_month',
        'log_year',
        'verify_mode',
        'in_out_mode',
        'work_code',
        'reserved'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
